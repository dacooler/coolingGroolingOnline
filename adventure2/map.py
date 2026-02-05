def buildPart(cords, size, clas):
    style  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "width: " + size[0] + "px; height: " + size[1] + "px"  
    part = "<div style=\"" + style + "\"></div>"

    styleCubed  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "--width: " + size[0] + "px; --height: " + size[1] + "px; --depth: " + size[2] + "px;"  
    if(len(size) >= 4):
        styleCubed += " --extra: " + size[3] + ";"

    cubes = "<div></div>"*6
    partCubed = "<div class=\"cubed " + clas + "\" style=\"" + styleCubed + "\">" + cubes + "</div>"
    return part, partCubed

def getMap():
  map = open("src/map.txt")
  cubes = map.read().split("\n")[:-1]
  cubesDone = ""
  cubesCubed = ""
  
  for cube in cubes:
    parts = cube.split(";")
    cords = parts[0].split(",")
    size = parts[1].split(",")
    clas = parts[2]
        

    addCube, addCubed = buildPart(cords, size, clas)
    if not (len(parts) >= 4 and parts[3] == "noCol"):
        cubesDone += addCube

    cubesCubed += addCubed
  map.close()
  return cubesDone, cubesCubed
  



  


