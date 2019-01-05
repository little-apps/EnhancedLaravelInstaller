<div class="tabs tabs-full">
	@foreach ($control->getControls() as $step)
		{!! Form::radio('tabs', null, $loop->first, ['id' => sprintf('tab%d', $loop->iteration), 'class' => 'tab-input']) !!}

		<label for="{{ sprintf('tab%d', $loop->iteration) }}" class="tab-label">
			<i class="{{ $step->icon }}" aria-hidden="true"></i>
			<br />
			{{ __($step->label) }}
        </label>
	@endforeach

	<form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="tabs-wrap">
		@csrf
		@each('vendor.installer.environment-wizard.step', $control->getControls(), 'control')
	</form>
</div>