@extends('layout')
@section('content')
<section class="pages container">
        <router-view></router-view>
		<div class="page page-contact">
			<h1 class="text-capitalize">Contacto</h1>
			<p>Para reportar problemas o sugerencias puede comunicarse con:</p>
			<div class="divider-2" style="margin:25px 0;"></div>
			<div class="form-contact">
				<ul>
                    <li>
                        Edwin Tello
                        <ul>
                            <li>Correo: alextello1@hotmail.com</li>
                        </ul>
                    </li>
                </ul>
			</div>
			
		</div>
	</section>
@endsection