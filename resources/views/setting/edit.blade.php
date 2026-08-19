@extends('layouts.app')

@section('title', 'Setting')

@section('content')

    <div class="container-fluid">

        <center></center>

        <h3>Setting</h3>

        @php
            $settings = [
                'General' => [
                    ['name' => 'App_Name', 'label' => 'App Name', 'type' => 'text', 'value' => ''],
                    ['name' => 'App_title', 'label' => 'App title', 'type' => 'text', 'value' => ''],
                    [
                        'name' => 'Master_password',
                        'label' => 'Master password',
                        'type' => 'text',
                        'value' => 'savsoftquiz',
                    ],
                    ['name' => 'Default_group_id', 'label' => 'Default group id', 'type' => 'text', 'value' => '1'],
                    ['name' => 'Enable_open_quiz', 'label' => 'Enable open quiz', 'type' => 'bool', 'value' => 'true'],
                    ['name' => 'Enable_sharethis', 'label' => 'Enable sharethis', 'type' => 'bool', 'value' => 'true'],
                    [
                        'name' => 'Language_direction',
                        'label' => 'Language direction',
                        'type' => 'text',
                        'value' => 'ltr',
                    ],
                    ['name' => 'Enable_web_cam', 'label' => 'Enable web cam', 'type' => 'bool', 'value' => 'true'],
                    [
                        'name' => 'Enable_google_chart',
                        'label' => 'Enable google chart',
                        'type' => 'bool',
                        'value' => 'true',
                    ],
                    ['name' => 'Enable_dompdf', 'label' => 'Enable dompdf', 'type' => 'bool', 'value' => 'true'],
                    [
                        'name' => 'Enable_user_registration',
                        'label' => 'Enable user registration',
                        'type' => 'bool',
                        'value' => 'true',
                    ],
                    [
                        'name' => 'Sharethis_property_id',
                        'label' => 'Sharethis property id',
                        'type' => 'text',
                        'value' => '',
                    ],
                    [
                        'name' => 'Advertisement_display_after_seconds',
                        'label' => 'Advertisement display after seconds',
                        'type' => 'text',
                        'value' => '60',
                    ],
                    [
                        'name' => 'Advertisement_display_for_seconds',
                        'label' => 'Advertisement display for seconds',
                        'type' => 'text',
                        'value' => '10',
                    ],
                    ['name' => 'Android_API_key', 'label' => 'Android API key', 'type' => 'text', 'value' => ''],
                ],
                'Email' => [
                    [
                        'name' => 'SMTP_hostname',
                        'label' => 'SMTP hostname',
                        'type' => 'text',
                        'value' => 'ssl://smtp.gmail.com',
                    ],
                    ['name' => 'SMTP_username', 'label' => 'SMTP username', 'type' => 'text', 'value' => ''],
                    ['name' => 'SMTP_password', 'label' => 'SMTP password', 'type' => 'text', 'value' => ''],
                    ['name' => 'SMTP_port', 'label' => 'SMTP port', 'type' => 'text', 'value' => '465'],
                    [
                        'name' => 'Verify_user_email',
                        'label' => 'Verify user email',
                        'type' => 'bool',
                        'value' => 'true',
                    ],
                    [
                        'name' => 'Send_result_email',
                        'label' => 'Send result email',
                        'type' => 'bool',
                        'value' => 'true',
                    ],
                    [
                        'name' => 'Result_email_subject',
                        'label' => 'Result email subject',
                        'type' => 'text',
                        'value' => 'Result generated for quiz [quiz_name]',
                    ],
                    [
                        'name' => 'Result_email_message',
                        'label' => 'Result email message',
                        'type' => 'text',
                        'value' =>
                            "Hi [last_name],\r\n \r\n  You have [result_status]  Quiz: '[quiz_name]' and obtained [percentage_obtained]% marks. To get more information please login to your quiz portal.\r\n  \r\n  Thanks",
                    ],
                    ['name' => 'SMTP_mailtype', 'label' => 'SMTP mailtype', 'type' => 'text', 'value' => 'text'],
                    ['name' => 'Email_protocol', 'label' => 'Email protocol', 'type' => 'text', 'value' => 'mail'],
                    [
                        'name' => 'Activation_email_subject',
                        'label' => 'Activation email subject',
                        'type' => 'text',
                        'value' => 'Action required to verify your account',
                    ],
                    [
                        'name' => 'Activation_email_message',
                        'label' => 'Activation email message',
                        'type' => 'text',
                        'value' =>
                            "Hi, \r\n Thank you for registering with us. Please click below link to verify your email address.\r\n <a href='[verilink]'>[verilink]</a> \r\n or \r\n Copy below link and visit in browser \r\n [verilink] \r\n \r\n Thanks",
                    ],
                    [
                        'name' => 'Password_change_subject',
                        'label' => 'Password change subject',
                        'type' => 'text',
                        'value' => 'Password Changed',
                    ],
                    [
                        'name' => 'Password_change_message',
                        'label' => 'Password change message',
                        'type' => 'text',
                        'value' => "Hi, \r\n Your New Password is: [new_password] \r\n Thanks",
                    ],
                ],
                'Editor' => [
                    ['name' => 'Tinymce_editor', 'label' => 'Tinymce editor', 'type' => 'bool', 'value' => 'true'],
                    [
                        'name' => 'Tinymce_eqneditor_plugin',
                        'label' => 'Tinymce eqneditor plugin',
                        'type' => 'bool',
                        'value' => 'true',
                    ],
                    [
                        'name' => 'Tinymce_wiris_plugin',
                        'label' => 'Tinymce wiris plugin',
                        'type' => 'bool',
                        'value' => 'true',
                    ],
                    ['name' => 'Mathjax', 'label' => 'Mathjax', 'type' => 'bool', 'value' => 'true'],
                ],
                'Payment Gateway' => [
                    [
                        'name' => 'Base_currency_prefix',
                        'label' => 'Base currency prefix',
                        'type' => 'text',
                        'value' => '$',
                    ],
                    [
                        'name' => 'Base_currency_sufix',
                        'label' => 'Base currency sufix',
                        'type' => 'text',
                        'value' => 'USD',
                    ],
                    [
                        'name' => 'Payment_gateways',
                        'label' => 'Payment gateways',
                        'type' => 'text',
                        'value' => 'paypal,checkout,payumoney,paytm',
                        'hint' => 'Comma separated',
                    ],
                    ['name' => 'Default_gateway', 'label' => 'Default gateway', 'type' => 'text', 'value' => 'paypal'],
                    ['name' => 'Enable_paypal', 'label' => 'Enable paypal', 'type' => 'bool', 'value' => 'true'],
                    [
                        'name' => 'Paypal_environment',
                        'label' => 'Paypal environment',
                        'type' => 'text',
                        'value' => '',
                        'hint' => 'Empty for real or sandbox',
                    ],
                    [
                        'name' => 'Paypal_receiver',
                        'label' => 'Paypal receiver',
                        'type' => 'text',
                        'value' => '',
                        'hint' => 'Paypal email id',
                    ],
                    [
                        'name' => 'Paypal_currency_prefix',
                        'label' => 'Paypal currency prefix',
                        'type' => 'text',
                        'value' => '$',
                    ],
                    [
                        'name' => 'Paypal_currency_sufix',
                        'label' => 'Paypal currency sufix',
                        'type' => 'text',
                        'value' => 'USD',
                    ],
                    [
                        'name' => 'Paypal_conversion',
                        'label' => 'Paypal conversion',
                        'type' => 'text',
                        'value' => '1',
                        'hint' => '1 if base currency is same',
                    ],
                    ['name' => 'Enable_checkout', 'label' => 'Enable checkout', 'type' => 'bool', 'value' => 'true'],
                    [
                        'name' => 'Checkout_environment',
                        'label' => 'Checkout environment',
                        'type' => 'text',
                        'value' => '',
                    ],
                    ['name' => 'Checkout_sid', 'label' => 'Checkout sid', 'type' => 'text', 'value' => ''],
                    [
                        'name' => 'Checkout_SecretWord',
                        'label' => 'Checkout SecretWord',
                        'type' => 'text',
                        'value' => '',
                    ],
                    ['name' => 'Checkout_receiver', 'label' => 'Checkout receiver', 'type' => 'text', 'value' => ''],
                    [
                        'name' => 'Checkout_currency_prefix',
                        'label' => 'Checkout currency prefix',
                        'type' => 'text',
                        'value' => '$',
                    ],
                    [
                        'name' => 'Checkout_currency_sufix',
                        'label' => 'Checkout currency sufix',
                        'type' => 'text',
                        'value' => 'USD',
                    ],
                    [
                        'name' => 'Checkout_conversion',
                        'label' => 'Checkout conversion',
                        'type' => 'text',
                        'value' => '1',
                    ],
                    ['name' => 'Enable_payumoney', 'label' => 'Enable payumoney', 'type' => 'bool', 'value' => 'false'],
                    ['name' => 'Payu_merchant_key', 'label' => 'Payu merchant key', 'type' => 'text', 'value' => ''],
                    ['name' => 'Payu_salt', 'label' => 'Payu salt', 'type' => 'text', 'value' => ''],
                    [
                        'name' => 'Payumoney_currency_prefix',
                        'label' => 'Payumoney currency prefix',
                        'type' => 'text',
                        'value' => 'Rs',
                    ],
                    [
                        'name' => 'Payumoney_currency_sufix',
                        'label' => 'Payumoney currency sufix',
                        'type' => 'text',
                        'value' => 'INR',
                    ],
                    [
                        'name' => 'Payumoney_conversion',
                        'label' => 'Payumoney conversion',
                        'type' => 'text',
                        'value' => '66',
                    ],
                    ['name' => 'Enable_paytm', 'label' => 'Enable paytm', 'type' => 'bool', 'value' => 'false'],
                    [
                        'name' => 'Paytm_environment',
                        'label' => 'Paytm environment',
                        'type' => 'text',
                        'value' => 'Test',
                    ],
                    ['name' => 'Paytm_merchant_key', 'label' => 'Paytm merchant key', 'type' => 'text', 'value' => ''],
                    ['name' => 'Paytm_merchant_id', 'label' => 'Paytm merchant id', 'type' => 'text', 'value' => ''],
                    [
                        'name' => 'Paytm_merchant_website',
                        'label' => 'Paytm merchant website',
                        'type' => 'text',
                        'value' => 'WEB_STAGING',
                    ],
                    [
                        'name' => 'Paytm_currency_prefix',
                        'label' => 'Paytm currency prefix',
                        'type' => 'text',
                        'value' => 'Rs',
                    ],
                    [
                        'name' => 'Paytm_currency_sufix',
                        'label' => 'Paytm currency sufix',
                        'type' => 'text',
                        'value' => 'INR',
                    ],
                    ['name' => 'Paytm_conversion', 'label' => 'Paytm conversion', 'type' => 'text', 'value' => ''],
                ],
            ];
        @endphp

        <form method="post" action="">
            @csrf

            <ul class="nav nav-tabs">
                @foreach (array_keys($settings) as $index => $tabName)
                    <li class="{{ $index == 0 ? 'active' : '' }}" style="background:#dddddd;margin-right:5px;">
                        <a data-toggle="tab" href="#tab{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}">{{ $tabName }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($settings as $tabName => $fields)
                    <div id="tab{{ $loop->index }}" class="tab-pane fade in {{ $loop->first ? 'active show' : '' }}">
                        <div class="card card-default">
                            <div class="card-heading" style="padding:5px;">{{ $tabName }}</div>
                            <div class="card-body">
                                @foreach ($fields as $field)
                                    <div class="form-group">
                                        <label>{{ $field['label'] }}</label>

                                        @if ($field['type'] === 'bool')
                                            <select name="{{ $field['name'] }}" class="form-control">
                                                <option value="true" @selected(old($field['name'], $field['value']) == 'true')>Enabled</option>
                                                <option value="false" @selected(old($field['name'], $field['value']) == 'false')>Disabled</option>
                                            </select>
                                        @else
                                            <input type="text" class="form-control" name="{{ $field['name'] }}"
                                                value="{{ old($field['name'], $field['value']) }}">
                                        @endif

                                        <span style="color:#666666;font-size:12px">{{ $field['hint'] ?? '' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <br>
            <button class="btn btn-default">Update</button>
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML" id="">
        </script>

    </div>

@endsection
