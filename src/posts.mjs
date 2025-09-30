//const config = require("./config");
import config from "./config.js";
//const fm = require("front-matter");
import fm from "front-matter";
import * as fs from "fs";
//const marked = require("marked");
import { marked } from "./marked.mjs";


const posthtml = data => `
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
	<link rel="stylesheet" href="../assets/cursedStyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="${data.attributes.description}" />
        <title>${data.attributes.title}</title>
    </head>

    <body id="grad1">
      <div>
        <div class="left" style="background-image:url('../assets/images/books.jpg')">
          <div class="list">
            <p>GAMES</p>
            <a href="files/coolGame.jar">COOLGAME</a>
            <a href="https://harald-thorsson.itch.io/robo-os">ROBO-OS</a>
            <a href="https://harald-thorsson.itch.io/rat-paul-elite-boxing">Rat Paul: Elite Boxing</a>
            <a href="https://vancia100.github.io/tripple-trouble/">Tripple Trouble</a>
            <p>COOL WEBSITES</p>
            <a href="http://thorsson.tplinkdns.com:55744/index.html">THORSSON tplinkdns</a>
            <button href="http://coolinggrooling.online" target="iframe_a" onclick="myFunction()">
              THIS SITE!!!! O:
              </button>
            <img src="../assets/images/DANC.gif" class="mitten">
          </div>
        </div>
      <div class="middle" id="this">
        <div class="content">
          <h1>${data.attributes.title}</h1>
          <p>${new Date(parseInt(data.attributes.date)).toDateString()}</p>
          <hr/>
          ${data.body}
        </div>
      <div id="grad">
        <div style="display:flex">
          <img class="title" src="../assets/images/cooltext.gif">
          <img class="title" src="../assets/images/number2.gif">
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
      <a href="http://cooltext.com" target="_top"><img src="https://cooltext.com/images/ct_button.gif" width="88" height="31" alt="Cool Text: Logo and Graphics Generator" /></a>
  </div>
</div>
</html>
`;


const createPosts = posts => {
  posts.forEach(post => {
    if (!fs.existsSync(`${config.dev.outdir}/${post.path}`))
      fs.mkdirSync(`${config.dev.outdir}/${post.path}`);

    fs.writeFile(
      `${config.dev.outdir}/${post.path}/index.html`,
      posthtml(post),
      e => {
        if (e) throw e;
        console.log(`${post.path}/index.html was created successfully`);
      }
    );
  });
};

const createPost = postPath => {
  const data = fs.readFileSync(config.dev.postsdir + "/" + postPath + ".md", "utf8");
  const content = fm(data);
  content.body = marked.parse(content.body);
  content.path = postPath;
  return content;
};


export { createPost, createPosts };
