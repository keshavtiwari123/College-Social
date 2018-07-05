@if(Session::has('info'))
	<div class="alert alert-info" role="alert" id="alert" hovertext="click to hide" style="cursor: pointer">
		{{Session::get('info')}}
	</div>
	<div id="hoverdiv"></div>
	<style type="text/css">
		#hoverdiv{
			display: none;
			color: red;
			padding: 5px;
			position: absolute;
			font-size: 20px;
			font-family: "Nunito Semibold";
			background-color: #f0f0f0;
			opacity: .5;
			border-radius: 5px;
			box-shadow: 2px 2px black;
		}
		</style>
@endif