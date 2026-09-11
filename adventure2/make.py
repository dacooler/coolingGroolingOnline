import os
from map import getMap

dir = "src/"
files = os.listdir(dir)
inName = "src/pIndex.html"
outName = "index.html"
changeFile = open(inName)
changeText = changeFile.read()
changeFile.close()
print(files)

def addSrc(inText: str) -> str:
    for file in files:
        fileText = open(dir + file)
        add = fileText.read()
        fileText.close()
        if "_" + file + "_" in inText:
            add = addSrc(add)
        inText = inText.replace("_" + file + "_", add)
    cubes, cubesCubed, size = getMap()
    inText = inText.replace("_WORLDMAP_", cubesCubed)
    inText = inText.replace("_CONTROLMAP_", cubes)
    inText = inText.replace("_MAP_SIZE_X_", str(size[0]))
    inText = inText.replace("_MAP_SIZE_Y_", str(size[1]))
    return inText

print("IN")
print("===============")
print(changeText)
print("===============")

changeText = addSrc(changeText)

print("OUT")
print("===============")
print(changeText)
print("===============")
with open(outName, "w") as f:
  f.write(changeText)

        
