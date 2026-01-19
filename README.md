# Astro Starter Kit: Basics

```sh
npm create astro@latest -- --template basics
```

> 🧑‍🚀 **Seasoned astronaut?** Delete this file. Have fun!

## 🚀 Project Structure

Inside of your Astro project, you'll see the following folders and files:

```text
/
├── public/
│   └── favicon.svg
├── src
│   ├── assets
│   │   └── astro.svg
│   ├── components
│   │   └── Welcome.astro
│   ├── layouts
│   │   └── Layout.astro
│   └── pages
│       └── index.astro
└── package.json
```

To learn more about the folder structure of an Astro project, refer to [our guide on project structure](https://docs.astro.build/en/basics/project-structure/).

## 🧞 Commands

All commands are run from the root of the project, from a terminal:

| Command                   | Action                                           |
| :------------------------ | :----------------------------------------------- |
| `npm install`             | Installs dependencies                            |
| `npm run dev`             | Starts local dev server at `localhost:4321`      |
| `npm run build`           | Build your production site to `./dist/`          |
| `npm run preview`         | Preview your build locally, before deploying     |
| `npm run astro ...`       | Run CLI commands like `astro add`, `astro check` |
| `npm run astro -- --help` | Get help using the Astro CLI                     |

## 👀 Want to learn more?

Feel free to check [our documentation](https://docs.astro.build) or jump into our [Discord server](https://astro.build/chat).

## Comandos github.
## Cosas que hay que hacer:
1. Siempre hay que crear una rama nueva  |  git checkout -b nombredelarama  |  Si solo se quiere crear se omite el -b

2. El nombre de la rama debe ser Feature-numero 

3. En caso de que se quiera cambiar de rama | git branch -> para ver las ramas existentes


## Paso a paso para hacer un PR.

1. Cambiarse de rama - hacer la rama con el nombre del ticket

2. Hacer commit -> esto se hace desde la interfaz gráfica, siempre se debe enviar todo

3. Se hace el git push -> git push origin nombredelarama

4. Luego de eso aparecerá la opción de hacer un PR -> hay que revisar que vaya de la rama develop a nombredelarama

5. Ya en git poner a todas las personas para que revisen

6. Enviarlo al grupo linkeandolo, hay que poner tanto el link del pr como el link del ticket.

## División de las ramas: 

1. La rama main será la que irá conectada al servidor, cuando los cambies se envíen a main, se verán reflados en el .com

2. La rama develop es la que se utilizará para desarrollar, ahí iran todos los cambios, una vez testeados se podrán enviar al main 
