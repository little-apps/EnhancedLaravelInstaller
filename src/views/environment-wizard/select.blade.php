<div class="form-group {{ $errors->has($option->getId()) ? ' has-error ' : '' }}">
	@include('vendor.installer.environment-wizard.label')

	{!! Form::select($option->getId(), $option->getOptions(), $option->getSelectExtras(), $option->getOptionExtras()) !!}

	@if ($errors->has($option->getId()))
		<span class="error-block">
			<i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
			{{ $errors->first($option->getId()) }}
		</span>
	@endif
</div>