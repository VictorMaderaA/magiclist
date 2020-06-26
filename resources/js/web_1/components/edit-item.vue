<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title align-middle">
                            Edit Item
                        </h3>

                        <div class="card-tools">
                            <a class="btn btn-sm" v-on:click="onClickCancel">
                                <i class="fas fa-times text-red"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" v-if="itemData">

                        <div class="row justify-content-center">
                            <div class="col-10 text-center">
                                <p class="text-danger" v-if="message.danger">{{ message.danger }}</p>
                                <p class="text-success" v-if="message.success">{{ message.success }}</p>
                            </div>
                        </div>



                        <form role="form">
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Order Pizza..." v-model="itemData.name">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-10">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Description</label>

                                        <div v-if="!form.showRawDesc">
                                            <editor-menu-bar :editor="form.editor" v-slot="{ commands, isActive, focused }">
                                                <div class="menubar is-hidden">

                                                    <button class="btn bt-sm btn-default"
                                                            v-on:click.capture.prevent="onClickRawDesc">
                                                        HTML
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.bold() }"
                                                            v-on:click.capture.prevent="commands.bold">
                                                        <i class="fas fa-bold"></i>
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.italic() }"
                                                            v-on:click.capture.prevent="commands.italic">
                                                        <i class="fas fa-italic"></i>
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.strike() }"
                                                            v-on:click.capture.prevent="commands.strike">
                                                        <i class="fas fa-strikethrough"></i>
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.underline() }"
                                                            v-on:click.capture.prevent="commands.underline">
                                                        <i class="fas fa-underline"></i>
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.paragraph() }"
                                                            v-on:click.capture.prevent="commands.paragraph">
                                                        <i class="fas fa-paragraph"></i>
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.heading({ level: 1 }) }"
                                                            v-on:click.capture.prevent="commands.heading({ level: 1 })">
                                                        H1
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.heading({ level: 2 }) }"
                                                            v-on:click.capture.prevent="commands.heading({ level: 2 })">
                                                        H2
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.heading({ level: 3 }) }"
                                                            v-on:click.capture.prevent="commands.heading({ level: 3 })">
                                                        H3
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.bullet_list() }"
                                                            v-on:click.capture.prevent="commands.bullet_list">
                                                        <i class="fas fa-list-ul"></i>
                                                    </button>

                                                    <button class="btn bt-sm"
                                                            :class="{ 'btn-default': isActive.ordered_list() }"
                                                            v-on:click.capture.prevent="commands.ordered_list">
                                                        <i class="fas fa-list-ol"></i>
                                                    </button>

                                                </div>
                                            </editor-menu-bar>
                                            <editor-content :editor="form.editor"
                                                            style="background: white; color: black; outline: none"/>
                                        </div>

                                        <div class="form-group" v-if="form.showRawDesc">
                                            <label for="rawDesc">
                                                <button class="btn bt-sm btn-default"
                                                        v-on:click.capture.prevent="onClickRawDesc">
                                                    Preview
                                                </button>
                                            </label>
                                            <textarea class="form-control" id="rawDesc" rows="5"
                                                      style="margin-top: 0; margin-bottom: 0; height: 266px;"
                                                      v-model="form.rawDesc"></textarea>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="input-group row justify-content-center">
                                <div class="col-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" ref="files"
                                               accept="image/*,.mp4,.gif" v-on:change="handleFileUploads()" multiple>
                                        <label class="custom-file-label" for="inputGroupFile01">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center" v-if="form.fileUploading">
                                <div class="col-auto text-center">
                                    <br>
                                    <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                    <div class="text-bold">Uploading...</div>
                                    <br>
                                </div>
                            </div>

                            <div class="input-group row justify-content-center">
                                <div class="col-10">
                                    <gallery :images="gallery" :index="index" @close="index = null"></gallery>
                                    <div
                                        class="image"
                                        v-for="(image, imageIndex) in gallery"
                                        :key="imageIndex"
                                        @click="index = imageIndex"
                                        :style="{ backgroundImage: 'url(' + image.href + ')', width: '150px', height: '100px' }"
                                    >
                                        <video width="150px" height="100px" v-if="image.isVideo">
                                            <source :src="image.href" :type="image.mimeType">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="card-footer" v-if="itemData">
                        <button type="submit" class="btn btn-primary"
                                v-on:click="onClickSave" :disabled="!canSave">Save</button>
                        <button type="submit" class="btn btn-default float-right"
                                v-on:click="onClickCancel">Cancel
                        </button>
                    </div>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </div>

</template>

<script>
    import {Editor, EditorContent, EditorMenuBar} from 'tiptap'
    import {
        Blockquote,
        Bold,
        BulletList,
        Code,
        CodeBlock,
        HardBreak,
        Heading,
        History,
        Italic,
        Link,
        ListItem,
        OrderedList,
        Strike,
        TodoItem,
        TodoList,
        Underline
    } from 'tiptap-extensions'
    import VueGallery from 'vue-gallery';
    import Manager from '../js/dataManager'

    export default {
        name: "edit-item",
        components: {
            EditorContent,
            EditorMenuBar,
            'gallery': VueGallery,
            Manager,
        },
        props: [
            'item'
        ],
        data() {
            return {
                index: null,

                message: {
                    danger: null,
                    success: null,
                },

                form: {
                    fileUploading: false,
                    showRawDesc: false,
                    rawDesc: '',
                    editor: new Editor({
                        extensions: [
                            new Blockquote(),
                            new CodeBlock(),
                            new HardBreak(),
                            new Heading({
                                levels: [1, 2, 3]
                            }),
                            new BulletList(),
                            new OrderedList(),
                            new ListItem(),
                            new TodoItem(),
                            new TodoList(),
                            new Bold(),
                            new Code(),
                            new Italic(),
                            new Link(),
                            new Strike(),
                            new Underline(),
                            new History(),
                        ],
                        content: null,
                    })
                },

                itemData: null,
            }
        },
        beforeMount() {
            if (this.item) {
                this.load(this.item);
            } else {
                console.error('Missing Item');
            }
        },
        beforeDestroy() {
            this.form.editor.destroy()
        },
        methods: {
            async load(item) {
                if (Number.isInteger(item)) {
                    let response = await Manager.reqGetActivity(item);
                    if (response.status === 200) {
                        this.loadItem(response.data)
                    } else {
                        this.failedLoad();
                    }
                } else {
                    this.loadItem(item);
                }
            },

            loadItem(item) {
                this.itemData = item;
                this.form.editor.setContent(item.description);
            },
            failedLoad() {
                console.error('Failed to load Item Data');
            },

            reqAddMedia: async function (activityId, formData) {
                const URL = '/api/activity/' + activityId + '/media';
                return axios.post(URL, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },


            onClickRawDesc() {
                if (this.form.showRawDesc) {
                    //Mostrando Raw
                    this.form.editor.setContent(this.form.rawDesc);
                } else {
                    //Mostrando Editor
                    this.form.rawDesc = this.form.editor.getHTML()
                }
                this.form.showRawDesc = !this.form.showRawDesc;
            },


            onClickCancel() {
                this.$emit('cancel');
            },

            async onClickSave(){
                let data = this.itemData;
                if (data.name) {
                    let desc = null;
                    if (this.form.showRawDesc) {
                        //Mostrando Raw
                        desc = this.form.rawDesc;
                    } else {
                        //Mostrando Editor
                        desc = this.form.editor.getHTML();
                    }

                    let activity = await Manager.updateActivity(data.id, data.name, desc, data.list_id);
                    if (activity) {
                        this.message.success = 'Created Successfully';
                        this.message.danger = null;

                    } else {
                        this.message.success = null;
                        this.message.danger = 'Something went wrong when trying to create the new activity';
                    }
                }
            },

            async handleFileUploads() {
                this.form.fileUploading = true;
                let files = this.$refs.files.files;
                if (files.length > 0) {
                    let formData = new FormData();
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];
                        formData.append('files[' + i + ']', file);
                    }
                    let response = await this.reqAddMedia(this.itemData.id, formData);
                    if (response.status === 200) {
                        this.itemData.media = this.itemData.media.concat(response.data);
                        console.log(response.data);
                    }
                }
                this.form.fileUploading = false;
            },

            canSave(){
                if(!this.itemData.name){
                    return false;
                }
                if(!this.itemData.list_id){
                    return false;
                }
                return true;
            }
        },
        computed: {
            gallery() {
                let gallery = [];
                if (this.itemData && this.itemData.media) {
                    for (let i = 0; i < this.itemData.media.length; i++) {
                        let media = this.itemData.media[i];
                        gallery.push({
                            title: media.name,
                            href: media.temp_url,
                            type: media.mimeType,
                            isVideo: (media.mimeType).includes('video')
                        })
                    }
                }
                return gallery;
            },

        }
    }
</script>

<style>

    .ProseMirror {
        display: block;
        width: 100%;
        height: 120%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .ProseMirror:focus {
        outline: none !important;
    }
</style>

<style scoped>

    .image {
        float: left;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        border: 1px solid #ebebeb;
        margin: 5px;
    }

</style>
