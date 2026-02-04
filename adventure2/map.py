def buildPart(cords, size, clas):
  style  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "width: " + size[0] + "px; height: " + size[1] + "px"  
  styleCubed  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "--width: " + size[0] + "px; --height: " + size[1] + "px; --depth: " + size[2] + "px"  
  part = "<div style=\"" + style + "\"></div>"
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
    cubesDone += addCube
    cubesCubed += addCubed
  map.close()
  return cubesDone, cubesCubed
  



  


