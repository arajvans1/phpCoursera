<html>
    <head>
        <title> Database Documentation!! </title> 
         <link type="text/css" rel="stylesheet" href="base1.css"> 
         <link rel="stylesheet"
            href="http://fonts.googleapis.com/css?family=Lato:100,300,400">
    </head>
    <body>
        <nav class="navigation"> 
            <a class="topLeft" href="postform1.php" >&lArr; Post Form</a>
            <a class="topRight" href="select01.php" > select querry &rArr;</a>
        </nav>
        <header class = "container">
        <h1>Database Documentation</h1> 
        </header>
        <section class="container">
        <pre class = "border">
        <h2> MYSQL DB </h2>
        Use this commmand on command line to connect to the database and enter password as root
        when prompted  -- /Applications/MAMP/Library/bin/mysql -u root -p

            other DB commands:
            - show databases;
            - create database misc;
            - GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
            - GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';
            - use dbname;
            - CREATE TABLE Persons (
                Personid int NOT NULL AUTO_INCREMENT,
                LastName varchar(255) NOT NULL,
                FirstName varchar(255),
                Age int,
                PRIMARY KEY (Personid)
                ); 
            - SHOW TABLES;
            - describe table;
            - insert into users (name,email,password) values ('amit', 'amit@gmail.com', 'password');

            - USING PDO 
            $pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc', 'arajvans', 'arajvans');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $pdo->query("select * from users");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                print_r($row);
                echo "\n";
            }

            $sql = "INSERT INTO users (name, email, password) 
              VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':name' => $nameOldValue,
                ':email' => $emailOldValue,
                ':password' => $passwordOldValue))
        </pre>
        <pre class="border">
        <h2> POSTGRES </h2>
        <img alt="" class="cf kg kh" src="https://miro.medium.com/max/1400/1*IW4iIzJdAX0kAmUGmZApnQ.png" width="700" height="350" role="presentation">
            - psql is the command line client 
            - psql  (this command logs you in as root)
            - psql &ltdbname&gt &ltusername&gt (this command logs you in to &ltdbname&gt as &ltusername&gt)
              ex - psql people pg4e;
            - \l -> list all databases
            - sudo -u postgres psql
            - create database mydb;
            - create user myuser with encrypted password 'mypass';
            - grant all privileges on database mydb to myuser;
            - alter user username with encrypted password 'password';
            - \c dbname -> connects to dbname database
            - \dt -> shows all tables 
            - \d+ tablename -> describes the table schema
            - \q  -> quits the db
            - wget https://www.pg4e.com/tools/sql/library.csv
            - curl -O https://www.pg4e.com/tools/sql/library.csv

            - psql -h pg.pg4e.com -p 5432 -U pg4e_38172a0c82 pg4e_38172a0c82
        
            - \copy track_raw(title,artist,album,count,rating,len) FROM 'library.csv' WITH DELIMITER ',' CSV;
            - Adding HEADER causes the CSV loader to skip the first line in the CSV file
             \copy unesco_raw(name,description,justification,year,longitude,latitude,area_hectares,category,
             state,region,iso) FROM 'whc-sites-2018-small.csv' WITH DELIMITER ',' CSV HEADER;
            - <span>update track_raw set album_id  = album.id from album where track_raw.album  = album.title; </span>
            -  use serial keyword for auto increment field 
                CREATE TABLE tablename (
                colname SERIAL);
                
                DROP TABLE IF EXISTS customers CASCADE;

                ALTER TABLE table_name
                    ADD COLUMN new_column_name data_type constraint;
                
                ALTER TABLE table_name 
                    RENAME COLUMN column_name TO new_column_name;
                
                create table student (
                    id serial,
                    name varchar(128) unique,
                    primary key (id)
                );

                drop table course;

                create table course (
                    id serial,
                    title varchar(128) unique,
                    primary key (id)
                );

                drop table roster;

                create table roster (
                    id serial,
                    student_id integer references student(id) on delete cascade,
                    course_id integer references course(id) on delete cascade,
                    role integer,
                    unique (student_id,course_id),
                    primary key (id)
                )



        </pre>  
        <br>  
        <h3> Database Modeling </h3>
        In a way, it's a form of compression through connection, if that makes any sense. 
        And so if you have an email address, csev@umich.edu, and you're going to have all kinds
        of places in the data of this application where something is owned by csev@umich.edu, the 
        basic rule is, and this is a form of compression, is you don't put that string in your database
        more than once. You put that string in once and then give it a key, like a number like 116,421.
        And instead of putting my email address throughout the Coursera data model, they just put that
        number. And so we need this number and if I author a discussion forum post, we use the number
        to indicate that I was the author of that. If you comment it, we use your number, we don't use
        your email address. If all goes well, we should have one table and one field and one copy of your
        email address in a database.  build a data model from a mock-up of the user interface to the 
        application. Now you might think, well, I'll just make this a CSV file, it doesn't look like 
        it's all that much data.The problem is that if you just make it a CSV file for 100 entries, it 
        might be fast and for 300 entries it might be fast. And then for 3 million entries, it's not fast.
        And then for 300 million entries,it's not fast. 
        The interesting thing about databases is you can have 300 million entries and
        it still can be fast. And the basic flaw in a CSV file, you end up with what I'll call
        <span>vertical replication</span>. you copy paste, copy paste, copy paste, copy paste. And that
        seems like it's okay, but if you start thinking about this, it's kind of frustrating. 
        Vertical replication of string data is not what we want to do. 
        I want to see all this vertical replication in the user interface. I just don't want to have it 
        in the database for efficiency purposes. So we accept the user interface and its needs as okay.
        We don't fight that. But what we have to do then is make a data model and then reconstruct from 
        that data model the user interface that they want. 
        So the idea is that you find sort of each string, number, each piece of data, and then you decide
        which table you're going to put it in.

        So you ask yourself, what is the single thing that this application is organizing? And this is a
        music system that tracks the tracks we own, and plays tracks, and keeps track of tracks that are
        parts of albums, and which albums belong to which, etc., etc. How many times we play the track,
        and after a while you figure out that maybe the track is the first thing that 
        we should work with. So let's basically make a table that has tracks. So we can look across and
        there's certainly like the title of the track. So we'll put the title in here. So we've got the
        title, so the track has a title. And then another thing that is pretty easy is numbers are no
        big deal, right? We don't worry about vertical replication of numbers. The fact that we have
        things that are both rated fours, numbers are cheap. So we'll just right away stick the length,
        we're going to stick the genre, and we're going to stick the number of plays, and the length
        and the genre, and we're just going to put those in the track. They're just all attributes of
        track, like length. we got the count, we got the rating, and then we got the track and that's 
        taken care of in that track title. So we got one table. what other things do we have? Well, we 
        have an album, right? And so this is the album and all tracks belong to albums. It's a little
        less of a mess if you're doing this in a whiteboard in an office, but you get the idea. 
        So tracks belong to albums and albums, well, albums you can't just put the artist's name in
         here because there could be many albums to one artist. And so you have an artist out here and 
         albums belong to artists. Right? So tracks belong to albums and albums belong to artists. So 
         we've got this done and we've got that done. So the only column we have left is the genre. 
         Now, the genre, let's see if we can get a different color here. Yeah, we could actually take
        the genre and we could connect it to the artist, we could connect it to the album, or we could
        connect it to the track. And this is a situation where actually the decision that we're going
        to make here is going to change how this will work. So if we connect it to the track, 
        you change this to a new thing and it won't affect any of the other tracks. But if you 
        connect it to the album, use this connection, the connection to the album, if you change it in 
        this album of Who Made Who, and you change Rock, the genre of Who Made Who, then all these are 
        going to change at the exact same moment. Right? And if you connect genre to the artist, all 
        the AC/DCs, I have many of them, of course. If you change the genre of AC/DC, then all the
        genres of all the AC/DC tracks are going to change at the same time. And so you can sit there 
        and you can argue, is the genre an attribute of artist? Is it an attribute of album? Or is it 
        an attribute of track? And the right answer in this one probably is track. And so you basically
        decide that you're going to connect genre to track and away you go. And you end up with a 
        picture that looks like that. Isn't it amazing how much nicer this picture looks than my 
        scribblings? So you have track, you have rating, you have length and count that are attributes 
        of track. They're just numbers, they're cheap. There's a title in track and that's probably 
        what's missing with this. There's a title here. This probably should be the track table with a
        title in it. Genre belongs to track. There is one genre and many tracks have one genre. Many
        tracks connect to one album and many albums connect to an artist. And so this is a way to 
        basically make it so that you'll, again, also notice that all the vertical representation,
        things that have vertical replication ended up with their own table and things that are just
        numbers and are otherwise not vertically replicated ended up as attributes in a table. 
        And so that's our data model. Now, you probably are thinking to yourself, well, that's not
        the most perfect data model, and the answer is, yes. We're going to simplify for now. 
        Some of these things about which artist belongs on which album. An artist might not always 
        be a group. It might be a set of individuals, but let's ignore that for now. But that's 
        the cool part of data models. At some point you might want to actually just build a really good
        music data model that doesn't have so many of these that is not quite as simple as this one. But
        for now, we're going to work on the mechanics of this and we're going to assume that this is a 
        good data model for which to model music. Up next, we're going to talk about how we build keys 
        and add keys to these tables so that we can make the connections in between tables.
        <br>
        <h3> Keys </h3>
        So now we're going to talk about the different kinds of keys, and what keys are is kind of <span>connection points</span>.
        We connect one row to another using a key, or we will go find a row in database table using a 
        key. And there are three kinds of keys.
        So each row in a table gets what we call a primary key, and that's like to give us a handle to say that row.
        So that's like the AC/DC row is number 42.The Led Zeppelin row is number 75. csev@umich is
        number 120,453. Those are the primary keys, and that's that single string.And then this number
        is what we're going to replicate all over the place. So that's a primary key.
        Then there is, in most tables, what we call a logical key.primary key is not something
        that you know what your primary key is, whereas the logical key is that's you, right? And so
        that is your email address, or the title of the track, or the title of the album, or the email
        address of the logged-in user, or something like that. So if you think of the outside world
        saying I've got to go find a particular person, or track, or whatever, they use the logical key.
        Or if it was in a user interface, and there was a search button, the thing you type into the
        search, that's the logical key, that's the thing that the world uses to find a row.
        And then the other thing that's sort of internal to the database is what's called the foreign
        key. And that is an integer in one table that points to a row in a different table. And that's
        why we call it a foreign key, that far away table is the "foreign" table, this is the local
        table. And we have a naming convention and different organizations and different pieces of 
        software will use different naming conventions. And so I've just chosen one of the more common 
        naming conventions, where in every table, in this case, the album table, the id field is going 
        to be the primary key. And so we'll just know that no matter what we name our table, we're going
        to name the primary key field id. Logical key will be whatever, and we use a convention of 
        foreign keys end in underscore id, and the first part is the name of the table. So I can look
        because of my convention that artist_id points to a row in the artist table. And when you go to 
        an organization, an important part of database is a set of rules and conventions that an
        organization uses to keep themselves sane.
        So the primary key is a somewhat counter-intuitive notion for a lot of people. You think to 
        yourself, well, your email address is your email address, and why you wouldn't you use that everywhere?
        And there are some database experts that might even tell you that's a good idea, but it's not a
        good idea, those databases experts are wrong. The key thing is that the whole thing that makes
        this super fast, no matter what database system you're using, is this mapping from a string to a
        number. And those people that would suggest that you could use a logical key as a primary key,
        meaning that you could put an email address everywhere, what they're really doing is using a 
        database layer to kind of fake it, to fake that. And there's still a number, it's just a number
        you're not dealing with. So you might as well go ahead and deal with the number. And things like
        email addresses change.And so if you're using as primary key like a string rather than a number,
        and people also use these things called GUIDs. Which are long strings of random numbers, and 
        then join on GUIDs, those things are not as efficient, although in some databases, they kind of
        fake the efficiency. And so the simple thing is just use integers as your foreign keys, integers
        as your primary keys, and strings or whatever as your logical keys.And then no matter what 
        database you're using, you're going to run very effectively. And like I said, a foreign key is a
        key that points to the primary key of another table. And so if we are pointing to a row in the
        artist table, we would name that artist_id. And again, I'll just say one last time, when the 
        primary keys are integers, then foreign keys are integers, and matching them is something that
        systems can do very efficiently. So up next, we're going to start using these foreign keys 
        and these primary keys as connecting together using what we call database normalization. We're
        going to like bring all of this together, and actually start kind of writing code.
        
        <br>
        <h3> Database Normalization </h3>

        So now that you know about primary keys, logical keys, and foreign keys, let's start using them.
        So remember our goal was to be able to keep track of all this stuff. And so we're going to have
        a track table, a artist table, an album table, and a genre table. And we're going to get these
        little numbers. And then we're going to use these numbers to keep track of all this stuff.
        Because we're going to have to then reconstruct it from those numbers to create the vertical 
        replication of the string data in the user interface just like our designer asked us to do. So
        you literally could spend months reading the concept of database normalization. Feel free, okay?

        From a technique perspective, it's pretty straightforward. First, don't replicate string data.
        Reference the data, point at data. It's a form of compression. Then use integer keys for your
        primary keys and for your references and put that primary key in each column, which we talked
        about already. So rows end up in these columns. And so when we're going to put AC/DC or Led 
        Zeppelin in, we just say, okay, here's Led Zeppelin. And Led Zeppelin for all intents and 
        purposes everywhere else in the system is going to be stored in a column called artist_id. And
        then that number goes in there. So Led Zeppelin is 1. AC/DC is 2. And once you insert them for
        pretty much the life of the system, although you can change them later if you really want. In 
        general you will just use 2 to indicate AC/DC and 1 to indicate Led Zeppelin from that point 
        forward in these foreign key columns. Now, you can have many sort of one primary key and you can 
        have many foreign keys pointing to it. It's just in our data model, it's pretty simple. So each
        of these little arrows that we drew just kind of scribbling on the board becomes sort of this 
        pair of numbers, a source number and a destination number or a parent and child is another way
        to think about it. So so we take this logical schema that we built of what belongs to what, 
        which we just were talking and brainstorming and getting our data spread into more than one 
        table. And now we're going to actually reconnect them together. And so we ended up with this
        picture that had these albums belonging to. And this was just a logical data model. And it 
        doesn't even have to look all this elegant, but you have to take this data and split it into 
        some number of tables, in our case four. And now we're going to show about the mechanics of 
        making all these connections. And so it's pretty simple. You've got this arrow and we have to 
        have a way in the arrow. There's no like in a database we say it's an arrow. They need columns. 
        We need to have a column in there and that column is an integer. So we add the columns. So we 
        augment the primary key and we add a primary key field to each one of the tables and then we 
        have a logical key. And the logical key is just another column except we distinguish it. We just
        put a little asterisk by it. Say this is special. This is the one we're going to use when we 
        have many rows to look up a particular row. Once we get to that row we'll find things like the 
        rating, length, and count, right? And so the database by us telling that the title of the track 
        is going to be something we're going to look up on, the database actually does stuff in how it 
        represents the data by building what are called indexes to make it more efficient to look those 
        things up, right? We talked about those indexes before. And so the logical key simply says 
        something that we would like you to make an index for because we're going to use it a lot. And 
        the faster you're capable of responding to lookups by title because we're not going to spend 
        all  that time looking it up by rating. We might sort by rating or whatever. But the thing we're 
        going to look up and we expect to be really fast is the logical key. So logically it's just a 
        column. It's a string column, a VARCHAR or whatever column. And these are just integer columns.
        But then to model the picture and this is what's called a many-to-one relationship, many-to-one. 
        And there are many tracks that are on one album and it's like another way to think about this is 
        it's somewhere between zero and infinite number of tracks per album. So that's also a way to 
        think about the many side of this arrow and so on the one side of the arrow, we just put in this
        primary key and on the many side, we add a column. And we call it album_id where the first part 
        of that is the name of the table and the second part of that is our little memory technique to 
        realize oh, that's a foreign key and it's in the album table. And so that's how we sort of in an 
        abstract way draw arrows. So we take and we map these arrows and we turn them into columns. So 
        it's a pretty mechanical process. Literally once you got it figured out, pick the logical key, 
        add the primary key, and add any necessary foreign keys based on the arrows that you've got. And 
        so when you finish this over and over and over again, we had four tables. We had three arrows. 
        And so we end up with one, two, three, four primary keys. We end up with a logical key in each 
        table. And then we had three arrows so we end up with three starting points. And then we put 
        foreign keys at the starting points of those arrows. And away we go. And so once you have the 
        picture you're kind of like follow the technique. I can write these things super fast and then I 
        can read them. They're really pretty. And again, I go back to the fact that I've used a 
        convention to build all this stuff. And I can look at this like, yeah, of course, that's a 
        foreign key. And it won't take you long and you'll start seeing the exact same thing that these 
        are foreign keys. So now that we've sort of built the structure, now we're going to start typing 
        some SQL commands so that we can insert create these tables with these special fields and then 
        start inserting some normalized data.
        <br>
        <h4>Using JOIN Across Tables </h4>
        So now that we've spread our data out across all these tables, created primary keys, and linked 
        them together with foreign keys, it is time to actually make some sense of it. And this is the 
        power of relational databases. Again, I've only showed you like a little of seven records. You 
        have to imagine millions, instead of seven. So now we're going to take these foreign keys and 
        we're going to traverse the foreign keys to walk across this web of information that's now 
        efficiently stored. The SQL construct that we use for this is called JOIN. The JOIN operation 
        links across several tables as part of a SELECT. So it's an extended SELECT that extends across 
        a number of tables. And you have to tell JOIN how to connect the tables and that's what's called 
        the ON clause. So we have all this data and these are just the tables that we just got done 
        creating. And so we have the id, and we have the foreign key, and so we're going to connect them 
        together. So we're going to get a SELECT. We want to produce an output that looks like this. We 
        don't want the numbers any more because that's not good for users. Those foreign keys or primary 
        keys are just bookkeeping stuff we do as database creators, but we want to make it so it looks 
        nice. So now we're going to have the SELECT. We have a slightly different format now. We have 
        the table name followed by the field within table album.title, artist.name. So we're now 
        selecting data from two tables, and so we say, oh well, FROM FROM. You can do this in either 
        order. So we're going to have two tables, the FROM the album table joined with the artist table. 
        So we're horizontally connecting the album and the artist table. And I follow the arrows. So I 
        start in the album table and then I'm kind of like looking these guys up, I'm saying,oh, okay, 2 
        and 1, I want to turn those into the strings. So you could do it either way, but I tend to go 
        FROM and I tend to follow it. So album joined with artist. Then we've connected these two 
        tables, but then we have to have this ON clause to say when rows are connected and we want the 1 
        to connect to 1 and 2 to connect to 2. That's important because that's meaning we in effect look 
        up the corresponding string of name, given the foreign key 1 or 2. Right? And so that's what the
        ON album.artist_id equals. That's the album artist_id field, and equals artist.id. Now again, 
        when you have a convention, I can look at this and I can note, okay, that's a table named album,
        artist_id is a foreign key into the artist table, artist.id is the primary key. And so I can see
        all that stuff. And so it goes through and it looks at all these things and it connects those 
        and shows us only the data. So one of the things that the SELECT, I didn't make too much of a 
        fuss about it, SELECT picks among the things that you could see. It shows you what you want to 
        see. We don't want to see the id, we don't want to see artist_id, or id from artist, but we 
        could see all that, okay? So SELECT picks what we want to see. So that's basically how we can 
        say, I'd like to see a little bit more. I want to see the album title, the album's artist_id, 
        the artist's id. So we're going to explore and show the data that is the part of the ON clause.
         Now, in the previous one we just didn't show it. So if we just add these and the rest of those, 
        it's just adding those things compared to the last one. And basically, you just get these two 
        columns where artist_id and id and then it just shows you how the ON clause has made that 
        connection for you. Now, that's what's called a INNER JOIN. So the INNER JOIN is filters where 
        they match, right? But in a sense, the JOIN is taking and looking at all possible combinations 
        of these things. Now, in a table where there's only two and two, the number of possible 
        combinations is four. All the rows of the first table combined with all the rows of the second 
        table, that is four. Now, you can actually express a JOIN, and it's called a CROSS JOIN. So the 
        INNER JOIN means take the things that match. CROSS JOIN means join everything. And you'll notice 
        that this CROSS JOIN doesn't have an ON clause because it doesn't need an ON clause. So track 
        CROSS JOIN with genre, says take all the combinations. And in this case, the track has four 
        items in it, and the genre has two items in it. So we end up with eight rows when we come back. 
        And we're also seeing the genre's id and the genre.id which is the thing we're eventually going 
        to use as the ON clause, but you'll notice in the CROSS JOIN, in particular the CROSS JOIN, we 
        both get the ones that match, and we get the ones that don't match. The difference between the 
        INNER JOIN is these ones that don't match, 2, 1, and these get chopped out when we're doing the 
        INNER JOIN, but the CROSS JOIN shows us all those. So the CROSS JOIN is like the INNER JOIN with 
        a WHERE clause. You can almost think of the ON clause as a WHERE clause after you've done a 
        CROSS JOIN. Normally, we don't want to do this, but sometimes we do want all combinations. This 
        is not a very efficient thing. Imagine a million on one side and a million on the other side. 
        You don't really want that. You just want the ON clause and the connection. I'm just showing you 
        this, not because I expected to do CROSS JOINs, but just so you kind of get the basic mechanics 
        of what JOIN is doing. It's like taking combinations and then filtering. The whole JOIN is these 
        eight rows, right? And the ON clause throws away the rows where these two fields don't match. 
        And in some databases, you do this not with a JOIN and an ON clause, but you just say, from 
        this, comma, that, comma, that, and put it on the WHERE clause. I don't think that's as pretty, 
        but you might. And that's okay. When we're going to do this with the INNER JOIN, which makes a 
        lot more sense, right? Now we're going to do an INNER JOIN. If you don't say INNER, it's an 
        INNER JOIN, which means it's filtering. You take all the tracks, and you look up and you put the 
        corresponding genre in. And we're only asking for track title and genre name. So this is a 
        normal JOIN, INNER JOIN, with an ON clause. And all I'm showing here is, this JOIN will 
        reconstruct that vertical replication, right? The JOIN will reconstruct the vertical 
        replication. The Rock, Rock, Metal, Metal. So that was the thing we didn't like, but that's the 
        thing we need for the user interface. And this gets complex, but again when I write this, I 
        write it really fast because all my JOINs look the same. All my field names look the same, all 
        my patterns look the same. So I'm going to say, I want to see the track title, the artist name, 
        the album title, and genre name from the track joined with the genre, and here's the matching 
        condition for that JOIN. Joined with the album, here's the matching condition for that JOIN. 
        Joined with the artist, and here's the matching condition for that JOIN. Again, you can kind of 
        see how I'm just going to copy and paste, change a little bit. And it's not that all bad. And 
        we're only seeing the text things. And now, what you see is you see the title of the track, you 
        see the name of the album, you see the name of the artist, you see the title of the album, and 
        then you see the genre. And you see all that vertical replication back. Again, I like to think 
        of this as with all of this, we compressed the database using numbers rather than strings and 
        JOIN reconstitutes the strings, but it's not stored anywhere. It's just sort of at the last 
        moment, we make the strings and we show them to the user. And then it's really efficient still 
        sitting in the database. And so that was a long set of data models, and serial columns, and IDs, 
        and foreign keys, and primary keys, and all that stuff just to go from the point where we had a 
        prototype UI that had vertical replication in it, to a database that had no string replication 
        in it, back to a UI that we can then reconstruct on the fly using all of this JOIN stuff. Now 
        the one thing I want to touch on is this ON DELETE CASCADE which I put in all those CREATE 
        statements. Now that we've done this, we can see how this ON DELETE CASCADE. So you can think of 
        a many-to-one relationship, meaning many tracks go to one genre, or you can think of the genre 
        as kind of a parent row. And the question would be, what if we removed that row? What would we 
        do with these? Because these point now to a row that doesn't exist. And so this is where the ON 
        DELETE CASCADE is helping us maintain these internal links. I told you that these are just kind 
        of integers, but when we have a constraint foreign key, we tell it that oh, I know what, when 
        this parent row gets deleted, what to do with the corresponding rows in this child field. Okay? 
        So when we say ON DELETE CASCADE, that means cascade delete from the parent into the child. So 
        once you delete this row, these rows are going to be gone too, okay? So if you run this command, 
        that is going to not just delete one row from the genre, but it's also going to delete two rows 
        from the track, right? We have four rows. We delete one row from genre and then we've 
        inadvertently as a side effect, we have deleted two rows. The ones that had a genre id of 2, 
        we've deleted those rows from the track as well. So that's how the ON DELETE CASCADE. Now, 
        there's more choices that you have. You can do RESTRICT, meaning that that delete of Metal 
        wouldn't work. Meaning that if you delete Metal from genre, then there's going to be these rows 
        in track that don't point. And then that would be a failure. It would blow up on us. Remember 
        that when SQL blows up, it's often because you or I asked it to enforce a rule. So if I said ON 
        DELETE RESTRICT, that means don't let me delete things if I would break my internal data model. 
        And you like that. It may seem wrong to you, like how come I can't do what I want to do. Well, 
        then tell it you want to do that. CASCADE is the one I tend to do because it keeps your data 
        model clean. So if you delete a parent row, you throw away the child row so the consistency is 
        maintained. And then the last thing you do is you can set it to null, which effectively deletes 
        not the whole row, but it deletes those foreign key columns. So you don't end up with the 2, you 
        end up with null in that. Meaning it doesn't point. Now, if you're going to do DELETE SET NULL, 
        you've got to allow your foreign key to have a value of null, because you can decide whether or 
        not is this an integer field or integer null. Meaning integer null field means I'm allowing 
        nulls in this field, which null is empty. So I'd have to say INTEGER NULL, if I was going to say 
        ON DELETE SET NULL. And it wouldn't even create the table that way. Again, you always think, 
        like, oh, it won't create the table, that's so mean. It's like no, just put DELETE CASCADE. I 
        don't know. It's a weird thing that you've got to get used to when you're building databases 
        where you're like, I have decided to make you enforce rules on me the programmer, because it 
        saves you all the time. So that's your choices for ON DELETE. So the next thing we're going to 
        take a look at is many-to-many relationships. And at this point, you're probably thinking, well,
        artists and albums, that's not quite right. Yeah, because they're not really one-to-many 
        relationships in the real world. So now we're going to get to an example that shows you the 
        other really valuable way of representing data called the many-to-many relationship.
        <br>
        <h3>Many-to-Many Relationships</h3>

        So many-to-many relationships are really important in databases so there are many tracks that point to one album. if you think to yourself, you know, what if there's more than one album for a track? So here's a track and it's on the original album and then it's on a compilation album and then it ends up on a soundtrack. You say, well how about if I call them album_id1, album_id2, and album_id3, wouldn't that work? So now I can have a track on three albums. Wouldn't that be pretty awesome? But the problem is that how does that stop, when does it stop? Because a track could be on a hundreds of albums, you don't know if one is the right number, three is the right number, or 100. So the idea of sort of making this almost like an array of album IDs is not going to work. First off, it's way expensive because you've got all those columns, you've got all rows that you may have zero albums or you may have 100 albums and if you have a 100 columns in the off chance that you need it? 
        It's like tracks could belong to more than one album and the album could have like 20 artists. So if you go back to the artist_id in album, artist_id1, artist_id2, oh, there's like five people in most bands. No, there's not. And then there's the writer and there's, okay. So you get many-to-many turns out to be the right way to do all the data models except genre, I think genre is fine. But album and artist, those relationships should have probably been many-to-many. And so this is just sort of how it looks in the one-to-many, we end up with two tables. One is like the from table and the to table or you could think of this one. I sort of think of this is the main table and so the track is the main table and the genre is a lookup table. You could say genre is the parent table and this is the child table. There's lots of ways to describe it.
        You could call this the many-to-one, the arrows go in different directions, but whatever. So this is what they look like, right? You've got two tables, you're going to reduce the vertical duplication in this one table by making a little table that has the strings in it and then using numbers to replace that vertical duplication. So that's the basic technique that we use for one-to-many. So many-to-many. We can't do it with one table. Now in a sense, if you draw a logical diagram you can still say there are many books and many authors and every author has many books and every book could have many authors and so you can't do in either direction a one-to-many. So in a logical diagram, you just like say this is a crow's feet many, crow;s feet many, crow's feet many. That's a logical diagram but it's not a physical diagram. So what we have to do in all these cases, is we can draw the arrows however we want in a logical diagram, but then we have to turn it into a physical diagram. So we do what's called a junction table or a join table or an immediate table or a through table or whatever. And what you basically do is you break this many-to-many into a series of one-to-manys, right? So this ends up being a one-to-many and then this ends up being a one-to-many and now we've turned it into two one-to-manys. It's probably just as easy for me to show it to you in a CREATE statement here. So I'm going to solve the problem of who is students in courses and teachers in courses at the same time. So students in courses and teachers in courses, one student could be in many courses, one course has many students. There's no way to say student, course one, course two, course three. You're not going to do that. And then course student one, student two, student three, it would just never work, right? So what we do is we make this table that's in the middle. We'll call it the membership table or the member table and it has two foreign keys. Now sometimes you put a primary key in to make it easy, sometimes you don't. In effect you make the student_id and course_id combination unique in this. Although there are times you don't do this but in this case we would make it unique. Now the interesting thing is you can also model data at the connection. So this connection is distinct for every student/course combination. And so this is the way in learning systems my account is different than your account and that I am marked as a teacher and you're marked as a student and that goes into this middle table. So you are not a teacher or a student. You're are a teacher and a student in a particular course. Okay? So the role you are in depends on the student, the user/course combination basically, right? And so we can actually model data at this connection and it's nice because there's a record in the member table that is distinct for each student/course combination. Okay? So foreign keys pointing to primary keys going outwards. So it's probably easier just to show this to you in SQL. So the first thing that we're going to do here is like we always do when we're making tables, is we're going to start from the edges and move in. We in a sense have to create the primary keys before we create the foreign keys. Because then the CREATE statements that include foreign keys will blow up. So they need the tables. So we have to create the student table and the course table. And at this point I hope is pretty normal to say id SERIAL, which is our primary key, name VARCHAR (128), which is just an attribute, email VARCHAR (128) UNIQUE that means it's kind of our way of saying it's our logical key, and the primary key for this is id. That's no different than anything else we've done before, right? And the same is true for course, id, is like kind of genre almost, id, and title, which is a VARCHAR and it's UNIQUE, and then PRIMARY KEY id. So we made two little leaf tables, basically, on our little tree. So the interesting thing happens when we start creating this middle table, right? And it's pretty straightforward. It's just two foreign keys pointing outward to two tables with primary keys. And then there's the data that's modeled at the middle, right? So we have student_id, which references the id field in the student table, ON DELETE CASCADE. Remember about ON DELETE CASCADE? That means that if we delete a student, the membership record is going to also be deleted. This is pretty obvious that DELETE CASCADE's great. Sometimes you might have other uses of ON DELETE. And then the same happens, we point outward to course through course_id, REFERENCES course_id ON DELETE CASCADE. Beautiful, beautiful, beautiful. role INTEGER. Now role is the data that's modeled at the point of connection, right? One student connects to one class and you're a teacher. One student points connect to one class and you're a student. That's data. And there might be more than one field there, right? So you might on one side have like a discussion thread and the other side might be a comment that says this user made this comment, and this might be the text of the comment, right? And so there are other ways to do that. Now the other thing that's cool and interesting about this is the PRIMARY KEY statement. The primary key for this table is not a single column. The primary key for this table is a combination of columns. And that basically says that you can only have one combination of a student_id and a course_id. That's important. Now, some of these you don't want that to be so strict. But the primary key is student_id and course_id. And that's why we don't need our own id SERIAL. If we were doing something like forums and comments, we might have an id, and then even like a date and time so we could order them so you could make as many comments on a forum as you wanted to make. But in this case, we're not going to have an id SERIAL, and we're going to make the primary key be the combination of student_id and course_id. It's beautiful. I mean honestly, I just think the prettiest thing is to not listen to my lecture at all and just gaze at the absolute beauty of SQL, because it is beautiful. It is so beautiful. So let's put some data in, not too surprising. Again, we're going to start from the leaves, just like we did before, insert some students, insert some courses, then we're going to figure out what their keys are, again there's vertical replication that we don't want to see happen, right? We don't want the student name or email to be replicated vertically anywhere or the course name be vertically replicated, so we need to make primary keys. So we got Jane is 1, Ed is 2, and Sue is 3, and Python is 1, SQL, and PHP. And now we just make the connections. And so these are even more abstract. Now, we're just going to use 1 as the role. So if you look at the role here, the role is the third parameter. Oh, yeah, the role is the third parameter here. So we're just going to use 1 for teacher and 0 for student. And so we're going to insert Jane into Python as the teacher. We're going to insert Ed into Python as a student. We're going to insert Sue into Python as a student, right? And then we're going to insert Jane into SQL as a student, and Ed into SQL as a teacher, and on and on. So these just become numbers, and again, we're using these numbers as like links right now. And so away we go. Right? And so then that plugs all these things together, and that's the data that we end up with in the join table, or the middle table, or the through table, the member table in this case, is really just a bunch of numbers. Although if this were comments and forums, there might be the comment text might also be modeled in this middle table, right? In the middle table here, the comments in the text might be modeled. And you might have a date and time and other stuff. In this case, it's super simple. We're unique on the student_id/course_id combination, and we're modeling just a number, which is the role, which is kind of how you do it with students. And then we have to reconstruct all this stuff. And so this is a JOIN to reconstruct it all, and again we're going to go across a couple of tables, select the student name, the role from the membership table, and the course title, from the student table joined to the member table according to the rules of member.student_id equals student.id. Again, pattern, pattern, pattern. JOIN course ON member.course.id. So remember the join is going outward here equals course.id, and ORDER BY course.title, member.role descending, and then the student name. So then we just see, and member,role descending, the reason I did that is so that the teacher shows up first. So now we see Ed and Sue in PHP, and the teacher, student, and then we see Jane, Ed, and Sue in Python, and we see Jane is the teacher in that case, and then we see Ed and Jane are in SQL, and we see Ed is the teacher in that case. So away we go. We get all of our data back. We can use joins to connect all these things. We can use WHERE clauses to figure out if somebody is even in a course. Away you go. And so this is sort of like if you take a look at this in a data model workbench, you can see these two things kind of pointing out from the middle table. And again, this was an example from a MySQL database that I've got in a project called Tsugi that is the thing that I use for autograders. So this has been quite a week. You certainly have used integer numbers for lots of things. We've used integer numbers to compress data, to reduce the size of the overall size of data and database, and then we use them for linking and we use them for primary keys, and so numbers turn out to be important. Normalizing data is turning them into integer keys. Why did we do all this? Why didn't we just make a spreadsheet with all these things in there? The answer is, it might seem like a trade-off that we had to do all this stuff, and we had to make up these numbers, but if you're going to build something that's important, that's worth storing in a database, it's likely going to get big, right? If it's small, you could just write a little Python program and do something. Read the file completely every time and make a dictionary in memory. But if you can't fit a dictionary in memory, you've got to use a database. There's no way you can say, well, I just bought a fast, bigger computer. And the answer is if your data's getting big like that, buying a 16-Gig computer does not solve your problem. So it might seem like a trade-off, but you need to spend this time to design the database. So when your application gets large, exceeds the size of the memory, so you can't just do a Python program, it continues to be fast. So this is an exciting thing, and we got so much more to talk about in SQL. This is just table stakes. It just gets us into the game so that I can talk about all these things, primary keys, foreign keys, logical keys, joins, so that you will understand it. And we're going to get into a lot more complex intricate ways to use SQL, but this covers all the basics that we need to get started.    
    </section><aside class="container-side"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed cursus massa, nec varius lectus. Phasellus eget justo urna. Suspendisse fermentum nisi quis turpis euismod ullamcorper. Integer non scelerisque neque. Morbi ipsum enim, hendrerit vitae efficitur at, gravida id nibh. Suspendisse eleifend dolor vel placerat volutpat. Donec cursus nisl quam. Sed sagittis, ante ut scelerisque tincidunt, sapien libero vehicula ante, quis congue ante nisi in nisl. Sed mattis laoreet lacus eu ullamcorper. Mauris odio metus, laoreet sit amet libero eget, sodales imperdiet justo. Ut feugiat eleifend ex vitae pretium. Sed non viverra tortor, eget gravida enim. Proin imperdiet urna varius fermentum sollicitudin. Morbi quis ultricies risus.

Donec sit amet tristique nibh, vel facilisis purus. Pellentesque sagittis dignissim ante, vitae faucibus est ultricies accumsan. Vivamus vel bibendum lectus, quis luctus metus. Nullam nunc dui, feugiat in elit nec, accumsan lobortis neque. Suspendisse vestibulum, mauris quis rutrum rhoncus, enim tellus congue sem, at hendrerit ligula dolor quis dui. Nulla commodo metus vitae ultrices cursus. Praesent bibendum lorem vel commodo hendrerit. Proin aliquet pharetra diam non sodales. Donec varius laoreet mi aliquet hendrerit. Nunc et dapibus tortor, sed aliquam nunc. Phasellus consequat arcu quis justo commodo, vel egestas quam malesuada. Suspendisse vel finibus est. Nam condimentum felis at augue ornare volutpat. Quisque blandit enim fringilla magna elementum, vel tincidunt est mattis.

Nulla in mi sodales, tempus odio sit amet, bibendum augue. Integer molestie maximus tempor. Sed ultrices, sem sit amet cursus gravida, sem est auctor neque, non sodales eros mi eget ligula. Sed hendrerit, tellus nec suscipit scelerisque, massa leo tincidunt turpis, vitae sodales tortor nunc at urna. Nam vestibulum quam in tortor cursus malesuada. Proin ut lorem sodales, feugiat metus in, lacinia sem. Fusce rutrum purus vitae tortor fringilla aliquet. Donec ut dui in lorem auctor ullamcorper. Nam id eleifend tortor. Nunc nec libero non est hendrerit elementum. Pellentesque aliquet pretium diam, quis ultricies purus consequat varius. Fusce congue magna a ligula blandit auctor.

In diam lorem, accumsan id erat vitae, hendrerit cursus metus. Fusce vestibulum orci dolor, ut mattis ligula rutrum vitae. Maecenas scelerisque eget neque et semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum tellus elit, luctus in luctus sed, dapibus eget elit. Pellentesque ipsum lacus, tincidunt nec nibh id, faucibus placerat mi. Fusce mollis aliquam commodo. Curabitur scelerisque odio et magna sollicitudin, non scelerisque purus faucibus.

</aside>
    </body>
</html>