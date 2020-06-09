<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title align-middle">
                        Edit <strong>{{name}}</strong>
                    </h3>

                    <div class="card-tools">
                        <a class="btn btn-sm" v-on:click="onClickCancel">
                            <i class="fas fa-times text-red"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="name">List Name</label>
                                <input type="text" class="form-control" id="name" ref="inputName"
                                       v-on:keyup.enter="$refs.inputDescription.focus()"
                                       placeholder="Cooking List..." v-model="list.name">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-10">
                            <!-- textarea -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="3" id="description" ref="inputDescription"
                                          placeholder="Enter description..." v-model="list.description"
                                          v-on:keyup.ctrl.enter="onClickSave"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"
                            :disabled="!list.name" v-on:click="onClickSave">Save</button>
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
        name: "edit-list",
        props: {
            listId: Number,
        },
        data() {
            return {
                name: null,
                list: {
                    name: null,
                    description: null,
                }
            }
        },
        beforeMount() {
            if(this.list){
                this.loadListData();
            }
        },
        methods: {
            async loadListData(){
                let response = await this.reqListData(this.listId);
                if(response.status === 200){
                    this.list = response.data;
                    this.name = this.list.name;
                }
            },
            reqListData: async function (listId) {
                const URL = '/api/list/' + listId;
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


            async onClickSave(){
                if(!this.list.name){
                    this.$refs.inputName.focus();
                    return;
                }
                let response = await this.reqSaveList(this.list.id, this.list.name, this.list.description);
                if(response.status === 200){
                    this.list = response.data;
                    // this.$emit('updated-list', response.data);
                }else{
                    //TODO
                }
            },
            reqSaveList: async function (listId, name, description) {
                const URL = '/api/list/' + listId;

                let data = {
                    name: name
                };
                if(description){
                    data.description = description;
                }

                return axios.post(URL, data)
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
