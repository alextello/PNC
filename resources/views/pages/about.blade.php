@extends('layout')
@section('content')
	
<section class="pages container">
		<router-view></router-view>
		<div class="page page-about">
			<h1 class="text-capitalize">Información:</h1>
			<cite>Sistema automatizado de reportes policiales</cite>
			<div class="divider-2" style="margin: 35px 0;"></div>
			<p>Este programa ha sido desarrollado como proyecto de graduacioón, por parte de la Universidad Mariano Gálvez, Quetzaltenango</p>
            <p>Facultad de ingeniería en sistemas</p>
            <ul>
                <li>Por: Edwin Alejandro Tello Santizo</li>
            </ul>
		</div>
	</section>
@endsection