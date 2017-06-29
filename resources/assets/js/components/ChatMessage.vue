<template>
    <li class="media messages">
        <div class="media-body">
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object img-circle " :src="message.image_path">
                </a>
                <div class="media-body">
                    <span  v-if="message.type == 1">
                        {{ message.message }}
                    </span>
                    <span v-else-if="message.type == 4">
                        <a :href="message.file_path" download>
                            <img :src="message.file_path" style="max-width:500px">
                            <!-- {{ message.file_name }} -->
                        </a>
                    </span>
                    <span v-else>
                        <a :href="message.file_path" download>
                            {{ message.file_name }}
                        </a>
                    </span>
                    <br>
                   <small class="text-muted">{{ message.user }} &nbsp;|&nbsp; <i class="fa fa-clock-o"></i> &nbsp;{{ formatTime(message.time) }}</small>
                    <hr>
                </div>
            </div>

        </div>
    </li>
</template>

<script>
    export default {
        props:['message'],
        data() {
            return {
                userName:$("#user_name").val()   
            }
        },
        methods:{
            formatTime (time) {
                let previousTime = moment(time,'YYYY-MM-DD HH:mm:ss').format('x');
                let timeDifference = moment(previousTime,'x').fromNow();
                return timeDifference;
            }
        }
    }
</script>
