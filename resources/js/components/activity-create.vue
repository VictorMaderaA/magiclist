<template>
    <div>
        <p class="text-danger" v-if="message.danger">{{ message.danger }}</p>
        <p class="text-success" v-if="message.success">{{ message.success }}</p>
        <div class="form-group">
            <label class="col-form-label" for="name">Name</label>
            <input type="text" maxlength="50" class="form-control" placeholder="Cooking List" id="name"
                   autocomplete="false" v-model="form.name">
        </div>
        <div>
            <div v-if="!form.showRawDesc">
                <editor-menu-bar :editor="form.editor" v-slot="{ commands, isActive, focused }">
                    <div class="menubar is-hidden">

                        <button class="menubar__button" :class="{ 'is-active': isActive.bold() }" @click="commands.bold">
                            <i class="icofont-bold"></i>
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.italic() }"
                                @click="commands.italic">
                            <i class="icofont-italic"></i>
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.strike() }"
                                @click="commands.strike">
                            <i class="icofont-strike-through"></i>
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.underline() }"
                                @click="commands.underline">
                            <i class="icofont-underline"></i>
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.paragraph() }"
                                @click="commands.paragraph">
                            <i class="icofont-paragraph"></i>
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                                @click="commands.heading({ level: 1 })">
                            H1
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                                @click="commands.heading({ level: 2 })">
                            H2
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                                @click="commands.heading({ level: 3 })">
                            H3
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.bullet_list() }"
                                @click="commands.bullet_list">
                            <i class="icofont-listine-dots"></i>
                        </button>

                        <button class="menubar__button" :class="{ 'is-active': isActive.ordered_list() }"
                                @click="commands.ordered_list">
                            <i class="icofont-listing-number"></i>
                        </button>


                        <button class="menubar__button"
                                @click="onClickRawDesc">
                            HTML
                        </button>
                    </div>
                </editor-menu-bar>
                <editor-content :editor="form.editor" style="background: white; color: black;"/>
            </div>
            <div class="form-group" v-if="form.showRawDesc">
                <label for="rawDesc">
                    Example textarea
                    <button class="menubar__button"
                            @click="onClickRawDesc">
                        Preview
                    </button>
                </label>
                <textarea class="form-control" id="rawDesc" rows="5"
                          style="margin-top: 0px; margin-bottom: 0px; height: 266px;"
                          v-model="form.rawDesc"></textarea>
            </div>
        </div>
        <button type="button" class="btn btn-success" v-on:click="onClickSave"
                :disabled="form.buttonEnabled">Save</button>
    </div>
</template>

<script>
    import {
        Editor,
        EditorContent,
        EditorMenuBar
    } from 'tiptap'
    import {
        Blockquote,
        CodeBlock,
        HardBreak,
        Heading,
        OrderedList,
        BulletList,
        ListItem,
        TodoItem,
        TodoList,
        Bold,
        Code,
        Italic,
        Link,
        Strike,
        Underline,
        History,
    } from 'tiptap-extensions'

    export default {
        name: "activity-create",
        components: {
            EditorContent,
            EditorMenuBar,
        },
        props: {
            listId: Number
        },
        data() {
            return {

                message: {
                    danger: null,
                    success: null,
                },
                form: {
                    name: null,
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
                        content: '',
                    }),
                    buttonEnabled: true
                }
            }
        },
        mounted() {
            console.log(this.listId)
        },
        beforeDestroy() {
            this.form.editor.destroy()
        },
        methods: {
            async onClickSave() {
                if (this.form.name) {
                    let desc = null;
                    if(this.form.showRawDesc){
                        //Mostrando Raw
                        desc = this.form.rawDesc;
                    }else{
                        //Mostrando Editor
                        desc = this.form.editor.getHTML();
                    }

                    let response = await this.reqSaveList(this.form.name, desc, this.listId);
                    if (response.status === 200) {
                        this.form.name = null;
                        this.form.editor.setContent('');
                        this.form.rawDesc = '';
                        this.activityCreated(response.data);
                        this.message.success = 'Created Successfully';
                        this.message.danger = null;

                    } else {
                        this.message.success = null;
                        this.message.danger = 'Something went wrong when trying to create the new activity';
                    }
                } else {
                    console.log('Cant Save');
                }
            },

            reqSaveList: async function (name, description, listId) {
                const URL = '/api/activity';
                return await axios.post(URL, {
                    name: name,
                    description: description,
                    listId: listId
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

            onClickRawDesc(){
                if(this.form.showRawDesc){
                    //Mostrando Raw
                    this.form.editor.setContent(this.form.rawDesc);
                }else{
                    //Mostrando Editor
                    this.form.rawDesc = this.form.editor.getHTML()
                }
                this.form.showRawDesc = !this.form.showRawDesc;
            },

            activityCreated(list) {
                this.$emit('created-activity', list)
            }
        },
        watch: {
            'form.name': function (val) {
                this.form.buttonEnabled = !val;
            }
        }
    }
</script>

<style scoped>

</style>
