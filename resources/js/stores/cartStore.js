import { ref, computed } from 'vue';

// Create a single store instance
const cartItems = ref(JSON.parse(localStorage.getItem('cart') || '[]'));

export const useCartStore = () => {
    const cart = computed(() => cartItems.value);

    const total = computed(() => {
        return cartItems.value.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    });

    const itemCount = computed(() => {
        return cartItems.value.reduce((sum, item) => sum + item.quantity, 0);
    });

    const addToCart = (item) => {
        const existingItem = cartItems.value.find(i => i.id === item.id);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cartItems.value.push({ ...item, quantity: 1 });
        }
        saveCart();
    };

    const removeFromCart = (itemId) => {
        cartItems.value = cartItems.value.filter(item => item.id !== itemId);
        saveCart();
    };

    const updateQuantity = (itemId, quantity) => {
        const item = cartItems.value.find(i => i.id === itemId);
        if (item) {
            item.quantity = quantity;
            if (item.quantity <= 0) {
                removeFromCart(itemId);
            } else {
                saveCart();
            }
        }
    };

    const clearCart = () => {
        cartItems.value = [];
        saveCart();
    };

    const saveCart = () => {
        localStorage.setItem('cart', JSON.stringify(cartItems.value));
    };

    return {
        cart,
        total,
        itemCount,
        addToCart,
        removeFromCart,
        updateQuantity,
        clearCart
    };
};
