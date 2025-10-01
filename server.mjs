import fs from "fs";
import http from "http";
import mime from "mime";
import express from "express";
const VISITOR_FILE = './visitors.json';
const QUOTE_FILE = "./quotes.json";

async function readTextFile(filename) {
	try {
		const data = await fs.promises.readFile(filename, 'utf8');
		return data;
	} catch (error) {
		console.error(`Error reading ${filename}: ${error}`);
		throw error.SHITPATH;
	}
}


async function getWebsiteFrom(filepath) {
	console.log(filepath);
	try {
		if (mime.getType("./public" + filepath) == "text/html") {
			const websiteFile = await readTextFile("./public/" + filepath);
			const replacements = [
				["_PageTitle_", "mega title"],
				["_Website_", websiteFile],
				["_VISITORS_", await getVisitorAmount()],
				["_QUOTE_", getRandomQuote()],
				["_STYLEPATH_", ""],

				["_CoolThing_", "GAGAGAG"],
			];
			const startFile = await readTextFile("./public/header.html");
			let website = startFile;
			website = replaceUsing(website, replacements);
			return website;
		}
		else {
			return await readTextFile("./public/" + filepath);
		}
	}
	catch {
		return false;
	}
}

function replaceUsing(website, replacements) {
	for (const replacement of replacements) {
		website = website.replace(replacement[0], replacement[1])
	}
	return website;
}

async function getFileWebsite(filepath) {
	let files = await fs.promises.readdir("./public" + filepath);
	let links = ``;
	const startFile = await readTextFile("./public/header.html");
	for (const file of files) {
		console.log(mime.getType(filepath + file));
		if (mime.getType(filepath + file) == "image/png") {
			links += `<a style="background-image:url('.${file}')" href="${file}">${file}</a><br>`;
		}
		else {
			links += `<a href="${file}">${file}</a><br>`;
		}
	}

	const replacements = [
		["_Website_", await fs.promises.readFile("./html/fileshare.html")],
		["_FOLDERNAME_", filepath],
		["_LINKS_", links],
		["_STYLEPATH_", ".."],
	]

	let website = replaceUsing(startFile, replacements);
	return website;
}

const app = express();
const port = 80;

app.get("/", async (req, res) => {
	let visitors = await getVisitorAmount();
	visitors++;
	setVisitorAmount(visitors)
	res.send(await getWebsiteFrom("index.html"));
}
);

app.get('/files/{*file}', async (req, res, next) => {
	console.log("HEYEA");
	const requestedPath = req.path
	console.log("Path: " + requestedPath);
	try {
		console.log(requestedPath);
		const stats = await fs.promises.stat("./public" + requestedPath);
		console.log(stats);
		if (stats.isDirectory) {
			try {
				let website = await getFileWebsite(`/files/${req.params.file ? req.params.file : ""}/`)
				res.send(website);
			}
			catch (e) {
				console.log("error reading shit" + e);
				next();
			}
		}
		else {
			console.log("gregre is file");
			next();
		}
	}
	catch (e) {
		console.log("OJOJOJ", e);
		next();
		res.status(418).send("ojojoj");
	}
}
);

app.use(express.static("public"));


app.listen(port, () => {
	console.log(`listening on port: ${port}`);
}
);

const quotes = JSON.parse(await fs.promises.readFile(QUOTE_FILE, "utf8"));

function getRandomQuote() {
	console.log(quotes);
	const quote = quotes.quotes[Math.random() * quotes.quotes.length >> 0]
	console.log(quote);
	return quote;
}

async function getVisitorAmount() {
	try {
		const jsonString = await fs.promises.readFile(VISITOR_FILE, "utf8");
		const visitors = JSON.parse(jsonString);
		console.log("[getVisitorAmount] Current visitors:", visitors.amount);
		return visitors.amount;
	} catch (err) {
		console.error("[getVisitorAmount] Error reading/parsing visitor file:", err);
		return 0; // Default to 0 if file doesn't exist or is corrupt
	}
}
async function setVisitorAmount(amount) {
	const visitors = { amount };
	try {
		await fs.promises.writeFile(VISITOR_FILE, JSON.stringify(visitors));
		console.log("[setVisitorAmount] Visitor count updated to:", amount);
	} catch (err) {
		console.error("[setVisitorAmount] Error writing visitor count:", err);
	}
}

