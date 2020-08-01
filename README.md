# OpenTexts

[OpenTexts](https://opentexts.world/) is an experimental service that provides free & open access to the digitised text collections of UK libraries.

## Running the site locally

### Clone the repo & initalise Docker

Clone the github repository:
`git clone https://github.com/opentexts/opentexts.git`

Initialise Docker:

```bash
docker-compose --env-file /dev/null up -d
```

### Configure your local environment

Save a copy of `env` as `.env` in your root directory.

Uncomment line 17 to show error messages:
`CI_ENVIRONMENT = development`

### Request access to the Solr index

Email Stuart (@stuartlewis) with your IP address (or range) to be added to the Solr firewall. This will allow you to see results when running a search.

### Install dependencies and start webpack

Run `npm install` to get all the npm modules you need to build the CSS, then `npm start` to run the development server.

Your local environment will be available at <http://localhost:8080/>

### Start editing 🥳

This project uses [Tailwind CSS](https://tailwindcss.com/), a utility-first CSS framework for rapidly building UIs. This means that most of the "design" work will happen right in next to your code.

User interface templates can be found in `https://github.com/opentexts/opentexts/tree/main/app/Views`

## Running a production build

Run `npm run build` to build the production CSS. Currently production CSS isn't checked into the app but this may change in the future.
