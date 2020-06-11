<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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



                        <div class="row justify-content-center">

                            <div class="col-sm-11">
                                <div class="form-group">
                                    <label for="name">List</label>
                                    <v-select :options="form.listOptions"
                                              :reduce="x => x.id"
                                              label="name"
                                              v-model="form.listId"></v-select>
                                </div>
                            </div>

                            <div class="col-sm-11">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="name">Item Name</label>
                                    <input type="text" class="form-control" id="name" v-model="form.name"
                                           placeholder="Date with Maruchan...">
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

                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <p>You can add media files by editing later.</p>
                            </div>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"
                                :disabled="!canSave" v-on:click="onClickSave">Save</button>
                        <button type="submit" class="btn btn-primary"
                                :disabled="!canSave" v-on:click="onClickSaveOther">Save & Create Other</button>
                        <!--                    <button type="submit" class="btn btn-primary"-->
                        <!--                            :disabled="!canSave" v-on:click="onClickSaveEdit">Save & Edit</button>-->
                        <button type="submit" class="btn btn-default float-right"
                                v-on:click="onClickCancel">Cancel</button>
                    </div>

                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </div>
</template>

<script>
    import 'vue-select/dist/vue-select.css';
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
    import Manager from '../js/dataManager'

    export default {
        name: "create-item",
        components: {
            EditorContent,
            EditorMenuBar,
            Manager,
        },
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
                    listId: null,

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
                let desc = '';
                if (this.form.showRawDesc) {
                    //Mostrando Raw
                    desc = this.form.rawDesc;
                } else {
                    //Mostrando Editor
                    desc = this.form.editor.getHTML();
                }
                let response = await Manager.reqCreateActivity(this.form.name, this.form.listId, desc);
                this.manageResponse(response);
                return response;
            },
            manageResponse(response){
                if(response.status === 200){
                    this.form.name = null;
                    this.form.editor.setContent('');
                    this.form.rawDesc = '';
                    this.message.success = 'Created Successfully';
                    this.message.danger = null;
                }else{
                    this.message.success = null;
                    this.message.danger = 'Something went wrong when trying to create the new activity';
                }
            },

            async loadListsOptions(){
                let response = await Manager.reqGetLists();
                if(response.status === 200){
                    this.form.listOptions = [];
                    response.data.forEach((x) => {
                        this.form.listOptions.push(x);
                    });
                }else{
                    //TODO
                }
            },

            onClickCancel(){
                this.$emit('cancel');
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
