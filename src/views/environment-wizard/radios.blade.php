<div class="form-group {{ $errors->has($option->getId()) ? ' has-error ' : '' }}">
	@include('vendor.installer.environment-wizard.label')

	{!! $option->renderControls() !!}

	@if ($errors->has($option->getId()))
		<span class="error-block">
			<i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
			{{ $errors->first($option->getId()) }}
		</span>
	@endif
</div>