@if(session()->has('flash_message'))
	<script>
		swal({
		  title: "{{ session('flash_message.titulo')}}",
		  text: "{{ session('flash_message.mensagem') }}",
		  type: "{{ session('flash_message.tipo') }}",
		  timer: 4000,
  		  showConfirmButton: false
		});
	</script>
@endif

@if(session()->has('flash_message_overlay'))
	<script>
		swal({
		  title: "{{ session('flash_message_overlay.titulo')}}",
		  text: "{{ session('flash_message_overlay.mensagem') }}",
		  type: "{{ session('flash_message_overlay.tipo') }}",
		  confirmButtonText: "Ok"
		});
	</script>
@endif

