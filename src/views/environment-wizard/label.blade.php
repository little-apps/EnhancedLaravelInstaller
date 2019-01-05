<label for="{{ $option->getId() }}">
	{{ __($option->getLabelText()) }}

	@if (is_array($option->hasLabelLink()))
		<sup>
			<a href="{{ $option->getLabelLink() }}" target="_blank" title="{{ $option->getLabelLinkText() }}">
				@if(!is_null($option->getLabelLinkIcon()))
				<i class="{{ $option->getLabelLinkIcon() }}" aria-hidden="true"></i>
				@endisset

				<span class="sr-only">{{ __($option->getLabelLinkText()) }}</span>
			</a>
		</sup>
	@endif
</label>