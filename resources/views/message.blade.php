@extends('layout')

@section('style')
    <style>[v-cloak] {
            display: none;
        }
    </style>
@endsection

@section('text')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div id="cont" v-cloak>
                            <small class="p_info_ok" v-if="status">{{__('messages.you_message_send')}}</small>
                            <form action="{{env('APP_URL').'/contact'}}" method="post" id="send_contact">
                                <div class="box-header with-border">
                                    @include('admin.errors')
                                    {{$info??''}}
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__('admin.name')}}</label>
                                            <input v-model.trim="name" type="text" class="form-control"
                                                   id="exampleInputEmail1"
                                                   placeholder=""
                                                   name="name">
                                            <small class="p_info_danger"
                                                   v-if="status_name">{{__('messages.invalid_entered')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__('admin.title')}}</label>
                                            <input v-model.trim="title" type="text" class="form-control"
                                                   id="exampleInputEmail1"
                                                   placeholder=""
                                                   name="title">
                                            <small v-if="status_title"
                                                   class="p_info_danger">{{__('messages.invalid_entered')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__('admin.email')}}</label>
                                            <input v-model.trim="email" type="text" class="form-control"
                                                   id="exampleInputEmail1"
                                                   placeholder=""
                                                   name="email">
                                            <small v-if="status_email"
                                                   class="p_info_danger">{{__('messages.invalid_entered')}}</small>
                                        </div>
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__('admin.text')}}</label>
                                            <textarea v-model.trim="content" id="" cols="30" rows="10"
                                                      class="form-control"
                                                      name="content">{{old('content')}}</textarea>
                                            <small v-if="status_content"
                                                   class="p_info_danger">{{__('messages.invalid_entered')}}</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button class="btn btn-default"
                                            onclick="window.history.back()">{{__('admin.back')}}</button>
                                    <button @click="sendMail" class="btn btn-success pull-right">
                                        {{__('admin.send')}}</button>
                                </div>
                            </form>       <!-- /.box-footer-->
                        </div>
                    </div>
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection

@section('js')
    <script>
        Vue.createApp({
            data() {
                return {
                    name: '',
                    title: '',
                    email: '',
                    content: '',
                    status_name: false,
                    status_title: false,
                    status_email: false,
                    status_content: false,
                    status: false
                }
            },
            methods: {
                sendMail(event) {
                    event.preventDefault();
                    const pattern = /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u;
                    if (this.name.length === 0) {
                        this.status_name = true
                        setTimeout(() => {
                            this.status_name = false
                        }, 5000)
                        return false;
                    } else if (this.title.length === 0) {
                        this.status_title = true
                        setTimeout(() => {
                            this.status_title = false
                        }, 5000)
                        return false;
                    } else if (this.email.length === 0 || !pattern.exec(this.email)) {
                        this.status_email = true
                        setTimeout(() => {
                            this.status_email = false
                        }, 5000)
                        return false;
                    } else if (this.content.length === 0) {
                        this.status_content = true
                        setTimeout(() => {
                            this.status_content = false
                        }, 5000)
                        return false;
                    } else {
                        const send = $('#send_contact')
                        $.ajax({
                            url: send.attr('action'),
                            type: send.attr('method'),
                            data: send.serialize()
                        }).done(() => {
                            this.status = true;
                            setTimeout(() => {
                                this.status = false;
                            }, 3000);
                            this.cleansFields();
                        })
                    }
                },
                cleansFields() {
                    this.name = '';
                    this.title = '';
                    this.email = '';
                    this.content = '';

                }
            }
        }).mount('#cont');
    </script>
@endsection
