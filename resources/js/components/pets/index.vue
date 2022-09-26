<template>
	<div class="container">
		<h2>Listado de Mascotas</h2>
		<div class="row d-flex flex-row-reverse container-fluid">
			<router-link to="/pets/create" class="btn btn-success" style="width: 10vw;"><strong><i class="fa fa-plus"></i> Nuevo</strong></router-link>
		</div>
		<br>
		<div class="card">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Raza</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="pet in pets" :key="pet.id">
						<td>{{ pet.id }}</td>
						<td>{{ pet.name }}</td>
						<td>{{ pet.address }}</td>
						<td>{{ pet.race_id != null ? pet.race.description : 'No posee' }}</td>
						<td>{{ pet.status == 'D' ? 'Disponible' : (pet.status == 'P' ? 'En Proceso' : 'Adoptado')  }}</td>
						<td class="d-flex flex-row-reverse">
							<button class="btn btn-danger ms-3" @click="deletePet(pet.id)"><strong><i class="fa fa-trash"></i> Eliminar</strong></button>
							<router-link :to="{name:'petEdit', params: {id: pet.id}}" class="btn btn-warning" style="width: 10vw;"><strong><i class="fa fa-edit"></i> Editar</strong></router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
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
			},

			async deletePet(id){
				document.querySelector('#loader-content').removeAttribute('hidden')
				await axios.delete('/api/pet/delete/'+id)
				.then(response=>{
					document.querySelector('#loader-content').setAttribute('hidden', true)
					alert(response.data.msg)
					this.$router.go()
				})
				.catch(error=>{
					document.querySelector('#loader-content').setAttribute('hidden', true)
					alert('No se pudo obtener la lista de Mascotas.')
				})
			}
		}
	}
</script>