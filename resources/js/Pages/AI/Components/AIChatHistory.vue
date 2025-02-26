<template>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">Chat History</h2>

        <div v-if="loading" class="flex justify-center py-8">
            <div class="w-8 h-8 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
        </div>

        <div v-else-if="conversations.length === 0" class="py-8 text-center text-gray-500">
            <p>No chat history found</p>
        </div>

        <div v-else class="space-y-4">
            <div
                v-for="conversation in conversations"
                :key="conversation.id"
                class="p-4 border rounded-lg hover:bg-gray-50 cursor-pointer"
                @click="selectConversation(conversation.id)"
            >
                <div class="flex items-center justify-between">
                    <h3 class="font-medium">{{ conversation.title }}</h3>
                    <span class="text-sm text-gray-500">{{ formatDate(conversation.created_at) }}</span>
                </div>
                <p class="mt-2 text-sm text-gray-600 truncate">
                    {{ getLastMessage(conversation.messages) }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, defineEmits } from 'vue';
import axios from 'axios';

const emit = defineEmits(['select-conversation']);
const conversations = ref([]);
const loading = ref(true);

onMounted(async () => {
    await loadConversations();
});

const loadConversations = async () => {
    loading.value = true;
    try {
        const response = await axios.get('/ai/conversations');
        if (response.data.success) {
            conversations.value = response.data.conversations;
        }
    } catch (error) {
        console.error('Failed to load conversations:', error);
    } finally {
        loading.value = false;
    }
};

const selectConversation = (id) => {
    emit('select-conversation', id);
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString();
};

const getLastMessage = (messages) => {
    if (!messages || messages.length === 0) return 'No messages';
    const lastMessage = messages[messages.length - 1];
    return lastMessage.content.substring(0, 60) + (lastMessage.content.length > 60 ? '...' : '');
};
</script>
