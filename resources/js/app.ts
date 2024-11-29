import './bootstrap';
import { Controller } from './controllers/Controller'
import { Service } from './services/Service'
import graphqlService from './services/GraphqlService'
import loginController from './controllers/LoginController'
import messageController from './controllers/MessageController'
import pageController from './controllers/PageController'
import navbarController from './controllers/NavbarController'
import profileController from './controllers/ProfileController'
import signupController from './controllers/SignupController'
import modalController from './controllers/ModalController'
import todoController from './controllers/TodoController'
import changeTodoController from './controllers/ChangeTodoController'
const addController = (name: string, controller: Controller) => (window as any)[name] = controller;
const addService = (name: string, service: Service) => (window as any)[name] = service;
//const addFunction = (name: string, fn: Function) => (window as any)[name] = fn;
// add client controllers
addService('graphqlService', graphqlService);
addController('loginController', loginController);
addController('messageController', messageController);
addController('pageController', pageController);
addController('navbarController', navbarController);
addController('profileController', profileController);
addController('signupController', signupController);
addController('modalController', modalController);
addController('todoController', todoController);
addController('changeTodoController', changeTodoController)
