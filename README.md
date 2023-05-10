# test-project

In order for the project to run correctly you have to execute the following:

Firstly you have to start docker and install dependencies : 
```
make start install
```

The next step is to deal with the database. Create and populate.
```
make create-mongo-schema populate-mongo-db
```

Last step run tests.
```
make phpunit
```

There is a makefile that can help you launch the necessary commands.

Once your docker is up you can test the app at [http://localhost:8000](http://localhost:8000)
