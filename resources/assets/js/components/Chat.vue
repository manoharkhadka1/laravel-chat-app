<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Name {{ fname }}</div>

                    <div class="panel-body">
                        Message {{ message }}
                    </div>
                </div>
            </div>
            <button class="btn btn-info">Here</button>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                fname:'manohar',
                message:'You good !'
            }
        }
    }
</script>
