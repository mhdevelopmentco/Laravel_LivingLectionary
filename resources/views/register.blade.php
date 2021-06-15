@extends('includes/page_master')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('/'); ?>">Home</a></li>
                    <li class="active">User Register</li>
                </ul>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">
                            {!! implode('', $errors->all(':message')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif

                <h3>Become a Member</h3>
                <h4 style="font-style: italic">Join the Living Lectionary</h4>

                <div class="content">

                    {!! Form::open(array('url'=>'register_submit','id'=>'register_form', 'class'=>'form-horizontal loginFrm')) !!}

                    <fieldset class="personal-data"><br/>
                        <!-- <h4 style="padding:10px;background:#eee;">Create your store</h4> -->
                        <div class="row-fluid">

                            <div class="control-group">
                                <label for="mem_fname" class="col-md-3">First Name*:</label>
                                <div class="col-md-9">
                                    <input type="text" id="mem_fname" name="mem_fname" class="form-control"
                                           required
                                           placeholder="" value="{!! Input::old('mem_fname') !!}"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="cus_last_name" class="col-md-3">Last Name*:</label>
                                <div class="col-md-9">
                                    <input type="text" id="mem_lname" name="mem_lname" class="form-control"
                                           required
                                           placeholder="" value="{!! Input::old('mem_lname') !!}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="mem_userid" class="col-md-3">Please enter an User ID name. We recommend
                                    using your email
                                    address*:</label>
                                <div class="col-md-9">
                                    <input type="text" id="mem_userid" name="mem_userid" class="form-control"
                                           required
                                           placeholder="" value="{!! Input::old('mem_userid') !!}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="mem_email" class="col-md-3">Email Address*:</label>
                                <div class="col-md-9">
                                    <input type="email" id="mem_email" name="mem_email" placeholder=""
                                           class="form-control" required
                                           value="{!! Input::old('mem_email') !!}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="cus_cemail" class="col-md-3">Confirm Email Address*:</label>
                                <div class="col-md-9">
                                    <input type="email" id="cus_cemail" name="cus_cemail" placeholder=""
                                           class="form-control"
                                           value="{!! Input::old('cus_cemail') !!}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="mem_password" class="col-md-3">Password*:</label>
                                <div class="col-md-9">
                                    <input type="password" id="mem_password" name="mem_password" placeholder=""
                                           class="form-control" required
                                           value="{!! Input::old('mem_password') !!}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="cus_cpwd" class="col-md-3">Confirm Password*:</label>
                                <div class="col-md-9">
                                    <input type="password" id="cus_cpwd" name="cus_cpwd" placeholder=""
                                           class="form-control"
                                           value="{!! Input::old('cus_cpwd') !!}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="mem_secq" class="col-md-3">Select a security question*:</label>
                                <div class="col-md-9">
                                    <select id="mem_secq" name="mem_secq" class="form-control"
                                            value="{!! Input::old('mem_secq') !!}" required>
                                        @forelse($security_questions as $sq)
                                            <option value="{{ $sq->id }}">{{$sq->question}}</option>
                                        @empty
                                            <option value="0">Select your security question</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="mem_seca" class="col-md-3">Answer*:</label>
                                <div class="col-md-9">
                                    <input type="text" id="mem_seca" name="mem_seca" placeholder=""
                                           class="form-control" required
                                           value="{!! Input::old('mem_seca') !!}">
                                </div>
                            </div>
                            <div class="control-group">
                                <!--label class="col-md-12">
                                    <input type="checkbox" name="agree" id="agree" required checked> I agree to use livinglectionary.org in accordance with the
                                    <a href="#terms_condition_modal" data-toggle="modal" type="button" title="Terms and conditions" class="forget_link" style="color:#ff8400;">
                                        Terms of Services
                                    </a> and
                                    <a href="#privacy_modal" data-toggle="modal" type="button" title="Terms and conditions" class="forget_link" style="color:#ff8400;">
                                        Content Usage Policy
                                    </a>
                                </label-->
                                <label class="col-md-12">
                                    <input type="checkbox" name="agree" id="agree" required checked> I agree to use
                                    livinglectionary.org in accordance with the
                                    <a href="{{ url('Terms_And_Conditions') }}" class="forget_link"
                                       style="color:#ff8400;" target="_blank">
                                        Terms of Service.
                                    </a>
                                </label>
                            </div>

                            <div class="control-group">
                                <label class="col-md-12"><input type="checkbox" name="newsletter" id="news" checked>Yes,
                                    sign me up to receive updates, devotions and promotions.</label>
                            </div>

                            <div class="control-group">
                                <div class="col-md-12">
                                    <input type="submit" id="register_submit" class="btn btn-warning" value="Sign Up"/>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </fieldset>
                </div>

                <div id="terms_condition_modal" class="modal hide fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Terms of Service</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <h3 class="m-t-none m-b"></h3>
                                        <?php if (isset($term)) {
                                            $content = stripslashes($term->tr_description);
                                        } else {
                                            $content = 'Yet To be Filled';
                                        } ?>
                                        <div id="term_content"><?php echo $content;?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                            class="icon icon-eye-close"></i> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.close').click(function () {
                $('.alert').hide();
            });

            //Validate Form
            //Password
            var password = document.getElementById("mem_password")
                    , confirm_password = document.getElementById("cus_cpwd");

            function validatePassword() {
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                    confirm_password.style.border = "1px solid red";
                } else {
                    confirm_password.setCustomValidity('');
                    confirm_password.style.border = "";
                }
            }

            password.onchange = validatePassword;
            confirm_password.onchange = validatePassword;

            var email = document.getElementById("mem_email")
                    , confirm_email = document.getElementById("cus_cemail");

            //Email
            function validateEmail() {
                if (email.value != confirm_email.value) {
                    confirm_email.setCustomValidity("Emails Don't Match");
                    confirm_email.style.border = "1px solid red";
                } else {
                    confirm_email.setCustomValidity('');
                    confirm_email.style.border = "";
                }
            }

            email.onchange = validateEmail;
            confirm_email.onchange = validateEmail;
        });
    </script>
@endsection