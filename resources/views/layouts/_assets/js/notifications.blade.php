<script>
	$(document).ready(function () {
        @if(notify()->ready())
		swal({
			@if(notify()->option('title'))
                title: "{!! notify()->option('title') !!}" ,
            @else
			    title: "{{ config('sweetalerts.default_title') }}",
            @endif
			@if(notify()->message())
                text: "{!! notify()->message() !!}" ,
            @else
			    text: "{!! config('sweetalerts.default_text') !!} ",
            @endif
			@if(notify()->type())
                type: "{{ notify()->type() }}" ,
            @else
			    type: "{{ config('sweetalerts.default_type') }}",
            @endif
			@if(notify()->option('timer'))
                timer: "{{ notify()->option('timer') }}" ,
            @else
			    timer: "{{ config('sweetalerts.default_timer') }}",
            @endif
			allowOutsideClick: false
		});
        @endif
	})
</script>
