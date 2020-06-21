<template>
    <div>
        <p class="text-danger" v-if="message.danger">{{ message.danger }}</p>
        <p class="text-success" v-if="message.success">{{ message.success }}</p>
        <div class="form-group">
            <label class="col-form-label" for="name">Name</label>
            <input type="text" maxlength="50" class="form-control" placeholder="Cooking List" id="name"
                   autocomplete="false"
                   v-model="form.name">
        </div>
        <button type="button" class="btn btn-success"
                v-on:click="onClickSave"
                :disabled="form.buttonEnabled">Save</button>
    </div>
</template>

<script>
    export default {
        name: "list-create",
        props: {

        },
        data() {
            return {
                message: {
                    danger: null,
                    success: null,
                },
                form: {
                    name: null,
                    buttonEnabled: true
                }
            }
        },
        methods: {
            async onClickSave(){
                if(this.form.name){
                    let response = await this.reqSaveList(this.form.name);
                    if(response.status === 200){
                        this.form.name = null;
                        this.listCreated(response.data);
                        this.message.success = 'Created Successfully';
                        this.message.danger = null;

                    }else {
                        this.message.success = null;
                        this.message.danger = 'Something went wrong when trying to create the new list';
                    }
                }else{
                    console.log('Cant Save');
                }
            },

            reqSaveList: async function (name) {
                const URL = '/api/list';
                return await axios.post(URL, {
                    name: name
                })
                    .then(function (resp) {
                        console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        console.error(err.response);
                        return err;
                    });
            },

            listCreated(list){
                this.$emit('created-list', list)
            }
        },
        watch: {
            'form.name': function(val){
                this.form.buttonEnabled = !val;
            }
        }

    }
</script>

<style scoped>

</style>
