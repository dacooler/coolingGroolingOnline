import config from "./config.js";
import fs from "fs";


const addHomePage = async posts => {
  let homepage = await fs.promises.readFile("./src/homepage.html");
  fs.writeFile(`${config.dev.outdir}/index.html`, homepage, e => {
    if (e) throw e;
    console.log(`index.html was created successfully`);
  });
};

export { addHomePage }
