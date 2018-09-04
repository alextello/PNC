<template>
    <div>
                <nav class="custom-wrapper" id="menu">
                    <div class="pure-menu"></div>
                    <ul class="container-flex list-unstyled">
                
                    <li>
                        <router-link :to="{name : 'home'}" class="text-uppercase">Inicio</router-link>
                    </li>
                        <li>
                            <router-link :to="{name : 'nosotros'}" class="text-uppercase">Acerca de</router-link>
                        </li>
                        <li>
                            <router-link :to="{name : 'archivo' }" class="text-uppercase">Archivo</router-link>
                        </li>
                        <li>
                            <router-link :to="{name : 'contacto' }" class="text-uppercase">Contacto</router-link>
                        </li>
                        <li>
                            <router-link :to="{name : 'login' }" class="text-uppercase">Login</router-link>
                        </li>
                    </ul>
                </nav>
    </div>
</template>

