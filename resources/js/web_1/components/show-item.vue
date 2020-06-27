<template>
    <section class="content">


        <div class="modal fade" id="modal-deleteItem" style="display: none;" aria-hidden="true" v-if="itemData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Are you sure? - Delete <strong><i>{{ itemData.name }}</i></strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please Confirm You Want To Delete This Item</p>
                        <p><strong>You will not be able to restore it later.</strong></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                                v-on:click="onClickDeleteItem(itemData.id)">
                            <strong>
                                DELETE
                            </strong>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>



        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title align-middle" v-if="itemData">
                                {{itemData.name}}
                            </h3>

                            <div class="card-tools">
                                <a class="btn btn-sm" v-on:click="onClickBack">
                                    <i class="far fa-list-alt"></i>
                                </a>

                                <a class="btn btn-sm" v-on:click="onClickEdit">
                                    <i class="fas fa-edit text-blue"></i>
                                </a>

                                <a class="btn btn-sm" data-toggle="modal" data-target="#modal-deleteItem">
                                    <i class="fas fa-trash text-red"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div v-if="itemData" v-html="itemData.description"></div>
                                    <div v-if="!itemData||!itemData.description">
                                        <h1>No Description</h1>
                                        <p v-on:click="onClickEdit">
                                            <u>Edit and add one.</u>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group row justify-content-center">

                                <div class="col-10 justify-items-center">
                                    <gallery :images="gallery"
                                             :index="index"
                                             @close="index = null"></gallery>
                                    <div class="d-flex flex-wrap">
                                        <div class="image"
                                             v-for="(image, imageIndex) in gallery"
                                             :key="imageIndex"
                                             @click="index = imageIndex"
                                             :style="{ backgroundImage: 'url(' + image.href + ')', width: '150px', height: '100px' }"
                                        >
                                            <video
                                                width="150px" height="100px" v-if="image.isVideo">
                                                <source :src="image.href" :type="image.mimeType">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </div>


    </section>

</template>

<script>
    import VueGallery from 'vue-gallery';
    import Manager from '../js/dataManager'

    export default {
        name: "show-item",
        props: {
            item: Number,
        },
        components: {
            'gallery': VueGallery,
            Manager,
        },
        data() {
            return {
                itemData: null,
                index: null,
            }
        },
        beforeMount() {
            if (this.item) {
                this.load(this.item);
            } else {
                console.error('Missing Item');
            }
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
            },
            failedLoad() {
                console.error('Failed to load Item Data');
            },

            async onClickDeleteItem(itemId){
                let response = await Manager.deleteActivity(itemId);
                if(response){
                    this.onDeleted()
                }else{
                    console.error('Failed to Delete element');
                }
                //TODO ELSE
            },


            onClickEdit() {
                this.$emit('edit-item');
            },
            onDeleted(){
                this.$emit('deleted');
            },
            onClickBack(){
                this.$emit('return');
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
