<template>

    <div class="row justify-content-center">
        <div class="col-md-6">
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
                    <form role="form">
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">List Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Cooking List..." v-model="itemData.name">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description"
                                              placeholder="Enter description..." v-model="itemData.description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="input-group row justify-content-center">
                            <div class="col-5">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                           accept="image/*|.mp4">
                                    <label class="custom-file-label" for="inputGroupFile01">Upload Images</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            Show interactable gallery
                        </div>

                    </form>
                </div>

                <div class="card-footer" v-if="itemData">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="submit" class="btn btn-default float-right"
                            v-on:click="onClickCancel">Cancel</button>
                </div>

            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->
</template>

<script>
    export default {
        name: "edit-item",
        props: [
            'item'
        ],
        data(){
            return{
                itemData: null,
            }
        },
        beforeMount() {
            console.log('edit-item prop.item', this.item);
            if(this.item){
                this.load(this.item);
            }else{
                console.error('Missing Item');
            }
        },
        methods:{
            async load(item){
                if(Number.isInteger(item)){
                    let response = await this.reqActivityData(item);
                    if(response.status === 200){
                        this.loadItem(response.data)
                    }else{
                        this.failedLoad();
                    }
                }else{
                    this.loadItem(item);
                }
            },

            loadItem(item){
                this.itemData = item;
            },
            failedLoad(){
                console.error('Failed to load Item Data');
            },


            reqActivityData: async function (activityId) {
                const URL = '/api/activity/' + activityId;
                return axios.get(URL, {})
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },


            onClickCancel(){
                this.$emit('cancel');
            }
        }
    }
</script>

<style scoped>

</style>
