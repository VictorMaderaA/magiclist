<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title align-middle">
                        Create New List
                    </h3>

                    <div class="card-tools">
                        <a class="btn btn-sm" v-on:click="onClickCancel">
                            <i class="fas fa-times text-red"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form">
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">List Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Cooking List..." v-model="form.name">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" id="description"
                                              placeholder="Enter description..." v-model="form.description"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"
                            :disabled="!form.name" v-on:click="onClickSave">Save</button>
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
        name: "create-list",
        data() {
            return {
                form: {
                    name: null,
                    description: '',
                }
            }
        },
        methods:{
            async onClickSave(){
                let response = await this.reqSaveList(this.form.name, this.form.description);
                if(response.status === 200){
                    this.$emit('created-list', response.data);
                }else{
                    //TODO
                }
            },
            reqSaveList: async function (name, description) {
                const URL = '/api/list';

                let data = {
                    name: name
                };
                if(description){
                    data.description = description;
                }

                return await axios.post(URL, data)
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
