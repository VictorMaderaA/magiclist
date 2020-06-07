<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title align-middle">
                        Create New Item
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
                        <div class="co-11">
                            <p class="text-danger" v-if="message.danger">{{ message.danger }}</p>
                            <p class="text-success" v-if="message.success">{{ message.success }}</p>
                        </div>
                    </div>
                    <form role="form">
                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">Item Name</label>
                                    <input type="text" class="form-control" id="name" v-model="form.name"
                                           placeholder="Date with Maruchan...">
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="name">List</label>
                                    <v-select :options="form.listOptions"
                                              :reduce="x => x.id"
                                              label="name"
                                              v-model="form.listId"></v-select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"
                            :disabled="!canSave" v-on:click="onClickSave">Save</button>
                    <button type="submit" class="btn btn-primary"
                            :disabled="!canSave" v-on:click="onClickSaveOther">Save & Create Other</button>
                    <button type="submit" class="btn btn-primary"
                            :disabled="!canSave" v-on:click="onClickSaveEdit">Save & Edit</button>
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
    import 'vue-select/dist/vue-select.css';

    export default {
        name: "create-item",
        props: {
            listid: Number
        },
        data(){
            return{
                message: {
                    danger: null,
                    success: null,
                },
                form: {
                    name: null,
                    listOptions: [],
                    listId: null
                }
            }
        },
        mounted() {
            this.loadListsOptions();
            if(this.listid){
                this.form.listId = this.listid;
            }
        },
        methods:{
            async onClickSave(){
                let response = await this.save();
                if(response.status === 200){
                    this.$emit('list-show', response.data.list_id);
                }
            },
            onClickSaveOther(){
                this.save();
            },
            async  onClickSaveEdit(){
                let response = await this.save();
                if(response.status === 200){
                    this.$emit('item-edit', response.data)
                }
            },

            async save(){
                let response = await this.reqSaveActivity(this.form.name, this.form.listId);
                this.manageResponse(response);
                return response;
            },
            manageResponse(response){
                if(response.status === 200){
                    this.form.name = null;
                    this.message.success = 'Created Successfully';
                    this.message.danger = null;
                }else{
                    this.message.success = null;
                    this.message.danger = 'Something went wrong when trying to create the new activity';
                }
            },

            async loadListsOptions(){
                let response = await this.reqListsData();
                if(response.status === 200){
                    this.form.listOptions = [];
                    response.data.forEach((x) => {
                        this.form.listOptions.push(x);
                    });
                }else{
                    //TODO
                }
            },

            reqListsData: async function () {
                const URL = '/api/list/';
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

            reqSaveActivity: async function (name, listId) {
                const URL = '/api/activity';
                return await axios.post(URL, {
                    name: name,
                    listId: listId
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



            onClickCancel(){
                this.$emit('cancel');
            }
        },
        computed: {
            canSave(){
                return !!(this.form.name && this.form.listId);
            },
        }
    }
</script>

<style scoped>

</style>
