<!DOCTYPE html>
<html lang="en">

<head>
<style type="text/css">
    html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
}
.header {
    width: 100%;
    height: 50px;
    position: fixed;
    top: 0;
    background: white;
}
#content {
    width: 97.5%;
    margin: 0 auto;
    padding-top: 40px;
    height: 500px;
    overflow-y: scroll;
}
.footer {
    width: 74%;
    height: 50px;
    position: fixed;
    bottom: 0;
    background: white;
}

.logout {
    bottom: 0;
    position: fixed;
    width: 18.5%;
}

.sidebar-nav li.active {
    text-decoration: none !important;
    color: #fff !important;
    background: rgba(255,255,255,0.2) !important;
}
.media-object {
    height: 50px;
    width: 50px;
}
/*scroll css begins*/

#content::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#content::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#content::-webkit-scrollbar-thumb
{
    background-color: #000000;
    border: 2px solid #555555;
}
#file {
    display: none;
}
.activate-chat {
    display: none;
}
/*scroll css ends*/
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Chat System with Laravel and Vue</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ url('../resources/assets/css/bootstrap.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('../resources/assets/css/simple-sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('../resources/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="css/sweetalert.css">

</head>

<body>

    <div id="wrapper">
        <div id="chatSection">
            <?php
                if(Auth::user()->image != 'null') {
                    $imageSrc = Auth::user()->image_path;
                } else {
                    $imageSrc = default_image;
                }
            ?>
            <input type="hidden" value="{{ Auth::user()->name }}" id="user_name">
            <input type="hidden" value="{{ Auth::user()->id }}" id="authId">
            <input type="hidden" value="{{ $imageSrc }}" id="default_image">
            <input type="hidden" value="{{ url('') }}" id="base_url">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Private Chat
                        </a>
                    </li>
                    <input type="text" class="form-control" placeholder="Search">
                    <user-log :users="users" v-on:getcurrentuser="getCurrentUser"></user-log>
                    <li class="logout">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout <i class="fa fa-sign-out"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chat-info">
                                <h2><span class="label label-success">Welcome to the chat-app</span></h2>
                                <p><span class="label label-default">Choose one of you friend from left sidebar to make a conversion.</span></p>
                            </div>
                            <div class="activate-chat">
                                <div class="header">

                                </div>
                                <div id="content" class="scrollbar">
                                    <ul class="messages" v-chat-scroll>
                                        <chat-log :messages="messages"></chat-log>
                                    </ul>
                                </div>
                                <div class="footer">
                                    <chat-composer v-on:messagesent="addMessage" :user-id="userId"></chat-composer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/app.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/moment.min.js"></script>
</body>

</html>
<script>
$(function(){
    $("#wrapper").toggleClass("toggled");
    var docHeight = $(document).height();
    var contentHeight = docHeight-72;
    $("#content").css('height',''+contentHeight+'px'); 
});
</script>