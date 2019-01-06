@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    {!! $container->makeView() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }
        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }
    </script>
@endsection
