<template>
    <div class="container mx-auto ">
        <!-- Chat Container -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Chat Header -->
            <div class="bg-gray-800 text-white p-4">
                <h2 class="text-lg font-semibold">Chat Room</h2>
            </div>

            <!-- Messages List -->
            <div class="p-4 bg-gray-50 h-96 overflow-y-auto">
                <div class="flex flex-col space-y-4">
                    <!-- Message Item -->
                    <div class="flex items-start" :class="message.sender_id === currentUser.id ? 'justify-end' : ''"
                        v-for="message in state.messages" :key="message.id">
                        <div class="p-3 rounded-lg max-w-xs"
                            :class="message.sender_id === currentUser.id ? 'bg-blue-500 text-white' : 'bg-gray-300'">
                            <p>{{ message.text }}</p>
                        </div>
                    </div>

                    <!-- Add more messages here -->
                </div>
            </div>

            <!-- Input Field -->
            <div class="p-4 bg-gray-100 border-t border-gray-200">
                <div class="flex items-center">
                    <input type="text" v-model="state.newMessage" @keyup.enter="sendMessage"
                        placeholder="Type your message..."
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                        @click="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, reactive } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    currentUser: {
        type: Object,
        required: true
    },
})

const state = reactive({
    messages: [],
    newMessage: ''
})

onMounted(() => {
    axios.get(`/messages/${props.user.id}`).then(response => {
        console.log();

        state.messages = response.data
    })
})

const sendMessage = () => {
    if (state.newMessage.trim() !== '') {
        axios.post(`/messages/${props.user.id}`, { text: state.newMessage })
            .then(response => {
                state.messages.push(response.data)
                state.newMessage = ''
            })
    }
}
</script>
