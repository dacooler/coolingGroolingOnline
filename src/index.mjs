//const fs = require("fs");
import * as fs from "fs";
import config from "./config.js";
import { addHomePage } from "./homepage.mjs";
//const config = require("./config");
import * as postMethods from "./posts.mjs";
//const postMethods = require("./posts.mjs");

const posts = fs
	.readdirSync(config.dev.postsdir)
	.map(post => post.slice(0, -3))
	.map(post => postMethods.createPost(post));

if (!fs.existsSync(config.dev.outdir)) fs.mkdirSync(config.dev.outdir);

postMethods.createPosts(posts);
addHomePage(posts);
console.log(posts);

