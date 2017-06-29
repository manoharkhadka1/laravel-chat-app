<template>
    <div class="user-log">
        <li v-for="user in users" :user="user"  v-bind:key="user.id" @click="activateUser(user)" :id="user.id">
            {{ user.name }}
        </li>
        <li v-show="users.length === 0" disabled>No friends found</li>
    </div>
</template>

<script>
    export default {
        methods:{
            activateUser (selectedUser) {
                this.$emit('getcurrentuser',{
                    userId:selectedUser.id
                });

                // show chat conversation
                $(".activate-chat").show();
                $(".chat-info").hide();
                // to make clicked li active
                $(".user-log .active").removeClass("active");
                $("#"+selectedUser.id).addClass("active");
            } 
        },
        data() {
            return {
                default_image:$("#default_image").val(),
                users:[]
            }
        },
        mounted() {
            // get users lists in left sidebar
            axios.get('/chat/public/users').then( response=> {
                this.users = response.data;
            });

        }
    }
</script>
