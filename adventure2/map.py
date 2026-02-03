def buildPart(cords, size):
  style  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "width: " + size[0] + "px; height: " + size[1] + "px"  
  styleCubed  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "--width: " + size[0] + "px; --height: " + size[1] + "px; --depth: " + size[2] + "px"  
  part = "<div style=\"" + style + "\"></div>"
  cubes = "<div></div>"*6
  partCubed = "<div class=\"cubed\" style=\"" + styleCubed + "\">" + cubes + "</div>"
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
    addCube, addCubed = buildPart(cords, size)
    cubesDone += addCube
    cubesCubed += addCubed
  map.close()
  return cubesDone, cubesCubed
  



  


