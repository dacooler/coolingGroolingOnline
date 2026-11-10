import os
from map.map.map import Map

dir = "src/"
files = os.listdir(dir)
inName = "src/pIndex.html"
outName = "index.html"
changeFile = open(inName)
changeText = changeFile.read()
changeFile.close()

editTemplateName = "src/eIndex.html"
editOutName = "edit.html"
editChangedFile = open(editTemplateName)
editChangedText = editChangedFile.read()
editChangedFile.close()
#print(files)

def addSrc(inText: str) -> str:
    for file in files:
        try:
            fileText = open(dir + file)
        except IsADirectoryError:
            continue
        except PermissionError:
            continue

        add = fileText.read()
        fileText.close()
        if "_" + file + "_" in inText:
            add = addSrc(add)
        inText = inText.replace("_" + file + "_", add)

    return inText

def addMap(inText: str, is_edit_mode: bool) -> str:
    map = Map()
    map.load()
    res = map.to_result(is_edit_mode)
    cubes = res.colliders
    cubesCubed = res.visual_cubes
    size = res.size
    height_differences = res.height_differences

    inText = inText.replace("_WORLDMAP_", cubesCubed)
    inText = inText.replace("_CONTROLMAP_", cubes)
    inText = inText.replace("_MAP_SIZE_X_", str(size[0]))
    inText = inText.replace("_MAP_SIZE_Y_", str(size[1]))
    inText = inText.replace("_HEIGHT_DIFFERENCE_", height_differences)

    return inText

#print("IN")
#print("===============")
#print(changeText)
#print("===============")

changeText = addSrc(changeText)
changeText = addMap(changeText, is_edit_mode=False)
editChangedText = addSrc(editChangedText)
editChangedText = addMap(editChangedText, is_edit_mode=True)

#print("OUT")
#print("===============")
#print(changeText)
#print("===============")
with open(outName, "w") as f:
  f.write(changeText)

with open(editOutName, "w") as f:
  f.write(editChangedText)

        
