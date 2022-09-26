import { createRouter, createWebHistory } from "vue-router";

const Home = ()=> import('./components/home.vue')

//Rutas Pets
const PetList = ()=> import('./components/pets/index.vue')
const PetShow = ()=> import('./components/pets/show.vue')
const PetCreate = ()=> import('./components/pets/create.vue')
const PetEdit = ()=> import('./components/pets/edit.vue')


const routes = [
	{
		name: 'home',
		path: '/',
		component:Home
	},
	{
		name: 'petList',
		path: '/pets',
		component:PetList
	},
	{
		name: 'petShow',
		path: '/pets/:id',
		component:PetShow
	},
	{
		name: 'petCreate',
		path: '/pets/create',
		component:PetCreate
	},
	{
		name: 'petEdit',
		path: '/pets/edit/:id',
		component:PetEdit
	}
]

const history = createWebHistory();

const router = createRouter({
	history,
	routes,
});

export default router;