<template>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <!-- Conversations Dropdown -->
        <div class="flex items-center justify-between mb-4">
            <select
                v-model="selectedConversation"
                class="px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                @change="loadConversation"
            >
                <option value="">New Conversation</option>
                <option v-for="conv in conversations" :key="conv.id" :value="conv.id">
                    {{ conv.title }}
                </option>
            </select>
            <button
                @click="saveCurrentConversation"
                class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600 disabled:opacity-50"
                :disabled="!messages.length || isLoading"
            >
                Save Conversation
            </button>
        </div>
        <!-- Rate Limit Info -->
        <div class="p-4 mb-4 text-sm rounded-lg bg-gray-50">
            <div class="flex items-center justify-between text-gray-600">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span>API Usage:</span>
                </div>
                <div class="flex gap-4">
                    <div>
                        <span class="font-medium">Remaining:</span>
                        <span class="ml-1" :class="{'text-red-500': rateLimit.remaining === 0}">
                            {{ rateLimit.remaining ?? '∞' }}/{{ rateLimit.limit ?? '∞' }}
                        </span>
                    </div>
                    <div>
                        <span class="font-medium">Tokens Used:</span>
                        <span class="ml-1">{{ rateLimit.tokens_used || '0' }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Model Tokens:</span>
                        <span class="ml-1">{{ rateLimit.model_tokens_used || '0' }}</span>
                    </div>
                    <div v-if="rateLimit.reset" class="text-xs">
                        <span class="font-medium">Resets in:</span>
                        <span class="ml-1">{{ formatResetTime(rateLimit.reset) }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div
                        class="h-2 transition-all duration-300 bg-indigo-500 rounded-full"
                        :style="{
                            width: `${(rateLimit.remaining / rateLimit.limit) * 100 || 100}%`
                        }"
                    ></div>
                </div>
            </div>
        </div>
        <div class="flex flex-col h-[600px]">
            <div class="flex-1 p-4 overflow-y-auto border rounded-lg" ref="chatContainer">
                <div class="space-y-4">
                    <div v-for="(message, index) in messages" :key="index"
                        :class="['flex gap-3', message.role === 'user' ? 'flex-row-reverse' : '']">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full"
                            :class="message.role === 'user' ? 'bg-indigo-500' : 'bg-gray-500'">
                        </div>
                        <div class="flex-1 p-4 rounded-lg max-w-[80%]"
                            :class="message.role === 'user' ? 'bg-indigo-50' : 'bg-gray-100'">
                            <div class="prose-sm prose" v-html="formatMessage(message.content || 'No message content')"></div>
                        </div>
                    </div>
                    <div v-if="isLoading" class="flex gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-500 rounded-full"></div>
                        <div class="flex-1 p-4 bg-gray-100 rounded-lg max-w-[80%]">
                            <div class="flex space-x-2">
                                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form @submit.prevent="sendMessage" class="flex gap-4 mt-4">
                <input
                    v-model="newMessage"
                    type="text"
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Type your message..."
                    :disabled="isLoading"
                >
                <button
                    type="submit"
                    class="px-6 py-2 text-white transition-colors bg-indigo-500 rounded-lg hover:bg-indigo-600 disabled:bg-indigo-300"
                    :disabled="isLoading || !newMessage.trim()"
                >
                    <span v-if="!isLoading">Send</span>
                    <span v-else>Sending...</span>
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick, watch } from 'vue';
import axios from 'axios';
import { marked } from 'marked';

const messages = ref([
    {
        role: 'assistant',
        content: 'Hello! How can I help you today?'
    }
]);
const newMessage = ref('');
const isLoading = ref(false);
const chatContainer = ref(null);
const rateLimit = ref({
    limit: null,
    remaining: null,
    reset: null,
    tokens_used: 0,
    model_tokens_used: 0
});
const conversations = ref([]);
const selectedConversation = ref('');

const formatMessage = (content) => {
    if (!content) return '';
    try {
        return marked(content);
    } catch (error) {
        console.error('Markdown parsing error:', error);
        return content;
    }
};

const scrollToBottom = async () => {
    await nextTick();
    if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
};

const sendMessage = async () => {
    if (!newMessage.value.trim() || isLoading.value) return;

    const userMessage = newMessage.value;
    messages.value.push({
        role: 'user',
        content: userMessage
    });
    newMessage.value = '';
    isLoading.value = true;

    try {
        const response = await axios.post('/ai/chat', {
            message: userMessage
        });

        if (response.data.success) {
            messages.value.push({
                role: 'assistant',
                content: response.data.message
            });
            // Update rate limit information
            if (response.data.rateLimit) {
                rateLimit.value = response.data.rateLimit;
            }
        }
    } catch (error) {
        console.error('Failed to get AI response:', error);
        messages.value.push({
            role: 'assistant',
            content: 'Sorry, I encountered an error. Please try again.'
        });
    } finally {
        isLoading.value = false;
    }
};

const checkRateLimit = async () => {
    try {
        const response = await axios.get('/ai/rate-limit');
        if (response.data.success) {
            rateLimit.value = response.data.rateLimit;
        }
    } catch (error) {
        console.error('Failed to check rate limit:', error);
    }
};

const formatResetTime = (resetTime) => {
    const reset = new Date(resetTime);
    const now = new Date();
    const diff = Math.max(0, Math.floor((reset - now) / 1000));

    if (diff < 60) return `${diff}s`;
    if (diff < 3600) return `${Math.floor(diff / 60)}m`;
    return `${Math.floor(diff / 3600)}h`;
};

const loadConversations = async () => {
    try {
        const response = await axios.get('/ai/conversations');
        if (response.data.success) {
            conversations.value = response.data.conversations;
        }
    } catch (error) {
        console.error('Failed to load conversations:', error);
    }
};

const loadConversation = () => {
    if (!selectedConversation.value) {
        messages.value = [{
            role: 'assistant',
            content: 'Hello! How can I help you today?'
        }];
        return;
    }

    const conversation = conversations.value.find(c => c.id === selectedConversation.value);
    if (conversation) {
        messages.value = conversation.messages;
        scrollToBottom();
    }
};

const saveCurrentConversation = async () => {
    try {
        const response = await axios.post('/ai/conversations', {
            messages: messages.value
        });

        if (response.data.success) {
            await loadConversations();
            selectedConversation.value = response.data.conversation.id;
        }
    } catch (error) {
        console.error('Failed to save conversation:', error);
    }
};

// Rate limit check interval
let rateLimitInterval;

watch(messages, () => {
    scrollToBottom();
}, { deep: true });

onMounted(() => {
    scrollToBottom();
    checkRateLimit();
    loadConversations();
    rateLimitInterval = setInterval(checkRateLimit, 60000);
});

onUnmounted(() => {
    if (rateLimitInterval) {
        clearInterval(rateLimitInterval);
    }
});
</script>

<style>
.prose pre {
    background-color: #f3f4f6;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
}

.prose code {
    background-color: #f3f4f6;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
}
</style>
