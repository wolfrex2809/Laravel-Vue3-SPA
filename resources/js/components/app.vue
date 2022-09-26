<template>
    <h1>Hola esta es una prueba con vue.js :)</h1>
    <hr>
    <router-view />
    <div id="loader-content" style="position: fixed; bottom: 0; z-index: 9999; width: 100vw; height: 100vh;" hidden>
        <center>
            <div style="margin-top: 45vh;" id="loader"></div>
        </center>
    </div>
</template>

<style>
    #loader {
      margin: auto;
      border: 10px solid #EAF0F6;
      border-radius: 50%;
      border-top: 10px solid #22b783;
      border-bottom: 10px solid #22b783;
      width: 10vh;
      height: 10vh;
      animation: spinner 1s linear infinite;
    }

    #loader-content{
        background-color: rgba(38, 46, 48, 0.5);
    }

    @keyframes spinner {


      0% { transform: rotate(0deg); opacity: 0;}

      50% {opacity: 1;}

      100% { transform: rotate(360deg); opacity: 0; }


    }
</style>