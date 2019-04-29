<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload</div>

                        <div class="card-body">
                            <div class="col-md-6">
                                <input type="file" name="video" id="video" @change="fileInputChange" v-if="!uploading">
                            </div>

                            <div id="video-form" v-if="uploading &&!failed">
                                Form
                            </div>

                       <!--  @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return {
                uploading: false,
                uploadingComplete: false,
                failed: false
            }
        },

        methods: {
            fileInputChange(){
                this.uploading = true;
                this.failed = false;


            }
        },

        ready(){

        }

    }
</script>
