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

                            <div class="alert alert-danger" v-if="failed">Something went wrong. Please try again.</div>

                            <div id="video-form" v-if="uploading &&!failed">
                                <div class="alert alert-info" v-if="!uploadingComplete">
                                    Your video will be available at {{ $root.url }}/videos/{{ uid }}
                                </div>

                                <div class="alert alert-success" v-if="uploadingComplete">Upload complete. Video is now processing. <a href="/videos">Go to your videos</a>
                                </div>

                                <div class="progress" v-if="!uploadingComplete">
                                    <div class="progress-bar" v-bind:style="{ width: fileProgress + '%' }"></div>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" v-model="title">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" v-model="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="visibility">Visibility</label>
                                    <select class="form-control" v-model="visibility">
                                        <option value="private">Private</option>
                                        <option value="public">Public</option>
                                        <option value="unlisted">Unlisted</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group row mb-0"> -->
                                    <!-- <div class="col-md-6 offset-md-4"> -->

                                        <button type="submit" class="btn btn-primary" @click.prevent="update">Save changes</button>
                                        <span class="help-block pull-right">{{ saveStatus }}</span>
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    // Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    export default {
        data(){
            //设定默认值
            return {
                uid: null,
                uploading: false,
                uploadingComplete: false,
                failed: false,
                title: 'Untitled',
                description: null,
                visibility: 'private',
                saveStatus: null,
                fileProgress: 0,
            }
        },
        methods: {
            fileInputChange(){
                this.uploading = true;
                this.failed = false;
                this.file = document.getElementById('video').files[0];
                //上传video
                this.store().then(() => {
                    console.log(1);
                    var form = new FormData();

                    form.append('video', this.file);
                    form.append('uid', this.uid);

                    this.$http.post('/upload', form, {
                        progress: (e) => {
                            if (e.lengthComputable) {
                                console.log(e.loaded + ' ' + e.total);
                                this.updateProgress(e)
                            }
                        }
                    }).then(() => {
                        this.uploadingComplete = true
                    }, () => {
                        this.failed = true
                    });
                }, () => {
                    this.failed = true
                })
            },

            store(){
                return this.$http.post('/videos', {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility,
                    extension: this.file.name.split('.').pop(),
                }).then((response) => {
                    this.uid = response.body.data.uid;
                });
            },

            update(){
                this.saveStatus = 'Saving changes.';

                return this.$http.put('/videos/'+this.uid, {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility

                }).then((response) => {
                    this.saveStatus = ' Changes saved.';

                    setTimeout(() => {
                        this.saveStatus = null
                    }, 3000)

                }, () => {
                    this.saveStatus = ' Failed to save changes';
                });
            },

            updateProgress (e) {
                e.percent = (e.loaded / e.total) * 100;
                this.fileProgress = e.percent;
            }
        },

        ready(){

        }

    }
</script>
