# The Hill - 02 - BCBB - Sweeney

## Summary

Group exercise performed during the Web Developer Junior training at Becode.

In this project, we have create a forum using PHP , MySQL, SASS & Bootstrap. The tooling use Docker.

## GitPage & Heroku

[https://bcbb-sweeney.herokuapp.com/](https://bcbb-sweeney.herokuapp.com/)

## Contributors

* [Quentin Lefèvre](https://github.com/Qlfvr)
* [Sarah Guillaume](https://github.com/SarahG4000)
* [Guillaume Boeur](https://github.com/Guillaume-Boeur)

---

## Part one - Basics : Complete instructions

### Features

You will design a database to handle four types of data :
* Users
* Boards
* Topics
* Messages

### Users

Users must be connected to interact; you will need to implement the creation of users (sign up) and the connection of users (sign in). Users will use an unique email and a password for authorization.

Users will also have a nickname (must be unique), an avatar (use Gravatar) and a signature (to show at the end ofeach users' messages).

Users will be able to modify their information ( except email) on a *profile page*.

### Boards

A Board is a logical group of Topics. There Will be four boards in your database : *General*, *Development*, *Smalltalk*, and *Event*.

Each Board has a name and a description.

When showing the list of the Boards, you need to show the last Topics: the three one with the most recent Message.

### Topics

A topic is a timeline of Messages.

Every user can create a Topic in a Board.
Each Topic has a title, a creation date, a content (which is kinda the first message) and an author (the User).

### Messages

A Message is a contribution from an user to a Topic.

Every User can add a Message to a Topic.

Each Message has a content, a create date, an author (an User), and an edition date.

The content must be rich : it must interprets *Markdown* and shows *Emojis*.

A Message can be edited by his author, and will show his edition date in that case.

A Message can be deleted by his author, and will be shown as "deleted" in the Topic.

---

## Deadline

* Part one : 02/03/2020 - 13/03/2020
* Part two : 

---

## Author

Guillaume Boeur, Quentin Lefèvre, Sarah Guillaume.
