<template>
    <div class="input-group message-sender-input">
        <span class="input-group-btn">
            <span class="btn btn-success upload_file" title="upload file" type="button" @click="chooseFile"><i class="fa fa-file"></i></span>
        </span>
        <input type="file" @change="onFlieChange" id="file">
        <input type="text" class="form-control" placeholder="Type your message here..." @keyup.enter="sendMessage"  v-model="messageText">
        <span class="input-group-btn">
            <button class="btn btn-success btn-send" type="button" @click="sendMessage">Send</button>
        </span>
    </div>
</template>

<script>
    export default {
        props:['userId'],
        data() {
            return {
                messageText: '',
                userName:$("#user_name").val(),
                userImage:$("#default_image").val(),
                errors:{},
                message:'',
                title:'',
                type:4,
                allowedExtensions:['pdf','jpg','jpeg','png','zip']   
            }
        },
        methods: {
            /**
             * send message
             * @return void
             */
            sendMessage() {
                let time = moment().format('YYYY-MM-DD HH:mm:ss');
                let data = {message:this.messageText,type:1};
                if(this.messageText != "") {

                    this.$emit('messagesent',{
                        message:this.messageText,
                        user:this.userName,
                        time:time,
                        image_path:this.userImage,//user.image_path,
                        type:'1',
                    });

                    axios.post('/chat/public/messages/'+this.userId,data).then( response=> {
                        // this.emitMessage(response);
                    });
                }
                this.messageText = '';
            },
            /**
             * show error messages
             * @param  {string} title 
             * @param  {string} message
             * @return {void}        
             */
            showError(title,message) {
                swal({
                  title: title,
                  text: message,
                  type: "error",
                  confirmButtonText: "Ok"
                });
            },
            /**
             * find extension of uploaded file
             * @param  {string} filename
             * @return {string}         
             */
            findExtension(filename) {
                return filename.split('.').pop().toLowerCase();
            },
            /**
             * to validate file size
             * @param  {integer} filesize
             * @return {boolean}         
             */
            validateSize(filesize) {
                // 2*1024*1024 = 2097152 = 2mb
                if(filesize > 2097152) {
                    this.title = "File size limit exceed!";
                    this.message = "Please upload file less than 2MB.";
                    this.showError(this.title,this.message);
                    return false;
                }
                return true;
            },
            /**
             * to validate file extension
             * @param  {string} extension
             * @return {bolean}          
             */
            validateExtension(extension) {
                if($.inArray(extension, this.allowedExtensions) !== -1) {
                    return true;
                } else {
                    this.title = "Invalid file!";
                    this.message = "Please upload jpg,png,pdf or zip file only.";
                    this.showError(this.title,this.message);
                    return false;
                }
            },
            /**
             * validate file
             * @param  {integer} filesize 
             * @param  {string} extension
             * @return {boolean}
             */
            validateFile(filesize,extension) {
                if(this.validateSize(filesize) && this.validateExtension(extension)) {
                    return true;
                } else {
                    return false;
                }

            },
            emitMessage(response) {
                let message = response.data.output.message;
                let user = response.data.output.user;
                if(message) {
                    this.$emit('messagesent',{
                        message:message.message,
                        user:user.name,
                        time:message.created_at,
                        image_path:$("#default_image").val(),//user.image_path,
                        type:message.type,
                        file_path:message.file_path,
                        file_name:message.file_name
                    });
                }
            },
            chooseFile() {
                $("#file").click();
            },
            onFlieChange(file) {
                let files = file.target.files || file.dataTransfer.files;
                let data = new FormData();
                if(files.length > 0) {
                    let file = files[0];
                    let filename = file.name;
                    let filesize = file.size;
                    let extension = this.findExtension(filename);
                    if(extension == 'pdf') {
                        this.type = 2;
                    } else if(extension == 'zip') {
                        this.type = 3;
                    }

                    // if uploaded file is valid with validation rules
                    if(this.validateFile(filesize,extension)) {
                        data.append('file',files[0]);
                        data.append('type',this.type);
                        axios.post('/chat/public/fileUpload/'+this.userId,data).then( response=> {
                            this.emitMessage(response);
                             
                        });
                    }
                }
                
            }
        }
    }
</script>