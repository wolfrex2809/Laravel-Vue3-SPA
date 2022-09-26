<template>
	<h2>Listado de Mascotas</h2>
	<hr>
	<div class="row d-flex flex-row-reverse container-fluid">
		<router-link to="/pets/create" class="btn btn-success" style="width: 10vw;"><strong><i class="fa fa-plus"></i> Nuevo</strong></router-link>
	</div>
	<div class="container-fluid">
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Direccion</th>
					<th>Raza</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="pet in pets" :key="pet.id">
					<td>{{ pet.id }}</td>
					<td>{{ pet.name }}</td>
					<td>{{ pet.address }}</td>
					<td>{{ pet.race_id != null ? pet.race.description : 'No posee' }}</td>
					<td>{{ pet.status == 'D' ? 'Disponible' : (pet.status == 'P' ? 'En Proceso' : 'Adoptado')  }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		name: 'pets',
		data(){
			return {
				pets: []
			}
		},
		mounted(){
			this.showList()
		},
		methods:{
			async showList(){
				document.querySelector('#loader-content').removeAttribute('hidden')
				await axios.get('/api/pet')
				.then(response=>{
					document.querySelector('#loader-content').setAttribute('hidden', true)
					this.pets = response.data
				})
				.catch(error=>{
					document.querySelector('#loader-content').setAttribute('hidden', true)
					alart('No se pudo obtener la lista de Mascotas.')
				})
			}
		}
	}
</script>