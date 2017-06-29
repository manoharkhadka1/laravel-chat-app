<template>
    <ul class="media-list messages">
        <chat-message v-for="message in messages" :message="message" :key="message.id"></chat-message>
    	<div v-show="messages.length === 0">Start new conversation...</div>
    </ul>
    	
</template>

<script>
    export default {
        props:['messages']
    }
</script>
