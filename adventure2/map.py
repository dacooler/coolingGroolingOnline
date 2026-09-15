from typing import Any
import json


class Coord:
    x: float
    y: float

    def __init__(self, x: float, y: float):
        self.x = x
        self.y = y

    @staticmethod
    def from_json(json: dict[str, float]):
        return Coord(json['x'], json['y'])

    def clone(self):
        return Coord(self.x, self.y)

    def __add__(self, other):
        if isinstance(other, Coord):
            return Coord(self.x + other.x, self.y + other.y)
        elif isinstance(other, list) or isinstance(other, tuple):
            return Coord(self.x + other[0], self.y + other[1])
        else:
            raise TypeError('Coord can only be added with other Coords or tuples or lists')


class Size:
    width: float
    height: float
    depth: float

    def __init__(self, width: float, height: float, depth: float):
        self.width = width
        self.height = height
        self.depth = depth

    @staticmethod
    def from_json(json: dict[str, float]):
        return Size(json['width'], json['height'], json['depth'])

    def clone(self):
        return Size(self.width, self.height, self.depth)


class Style:
    property: str
    value: Any
    unit: str

    def __init__(self, property: str, value: Any, unit: str):
        self.property = property
        self.value = value
        self.unit = unit

    def __str__(self):
        return f'{self.property}: {self.value}{self.unit};'


class HtmlElement:
    tag: str = 'div'
    children: list['HtmlElement']
    styles: list[Style]
    css_classes: list[str]

    def __init__(self, tag: str = 'div', children: list['HtmlElement'] = [], style: list[Style] = [], css_classes: list[str] = []):
        if tag: self.tag = tag

        if children:
            self.children = children
        else:
            self.children = []

        if style:
            self.styles = style
        else:
            self.styles = []

        if css_classes:
            self.css_classes = css_classes
        else:
            self.css_classes = []

    def __str__(self):
        name = f'<{self.tag}'

        if self.css_classes:
            name += ' class="'
            for css_class in self.css_classes:
                name += css_class + " "
            name += '"'
        
        if self.styles:
            name += ' style="'
            for style in self.styles:
                name += str(style) + " "
            name += '"'

        name += '>'
        for child in self.children:
            name += '\n'
            name += str(child)
        if self.children: name += '\n'

        name += f'</{self.tag}>'

        return name


"""Class representing a single part. Has a visual cube and a collision rect."""
class Part:
    position: Coord
    size: Size
    css_classes: list[str]
    args: list[str]

    def __init__(self, position: Coord, size: Size, css_classes: list[str], args: list[str] = []):
        self.position = position
        self.size = size
        self.css_classes = css_classes
        self.args = args

    def get_collision_rect(self):
        """The collision rect of this part. Will be just a simple rectangle div."""
        return HtmlElement(
            'div',
            style=[
                Style('left', self.position.x, 'px'),
                Style('top', self.position.y, 'px'),
                Style('width', self.size.width, 'px'),
                Style('height', self.size.height, 'px'),
            ]
        )

    def get_visual_cube(self):
        """The visual component of this part. Will be a cube with a certain texture."""
        style=[
            Style('left', self.position.x, 'px'),
            Style('top', self.position.y, 'px'),
            Style('--width', self.size.width, 'px'),
            Style('--height', self.size.height, 'px'),
            Style('--depth', self.size.depth, 'px'),
        ] + [
            Style(f'--arg{i}', arg, '') for i, arg in enumerate(self.args)
        ]

        return HtmlElement(
            css_classes=['cubed'] + self.css_classes,
            style=style,
            children=[HtmlElement('div') for _ in range(6)]
        )
        
    def clone(self):
        return Part(self.position.clone(), self.size.clone(), list(self.css_classes), list(self.args))


class Door:
    position: float
    width: float

    def __init__(self, position: float, width: float):
        self.position = position
        self.width = width

    def __lt__(self, other: 'Door'):
        return self.position < other.position

    def __str__(self):
        return f'Door(position={self.position}, width={self.width})'

    def __repr__(self):
        return str(self)


class Doors:
    """Represents the 4 (or more) doors of a normal house. (yes, a normal house has 4 (or more) doors (or less))."""
    _wall_doors: list[list[Door]]

    def __init__(self):
        self._wall_doors = [[], [], [], []]

    def get_doors_of_wall(self, wall_index: int):
        return self._wall_doors[wall_index]

    @staticmethod
    def from_json(json: list[dict[str, Any]]):
        doors = Doors()
        for door_json in json:
            door = Door(
                door_json['position'],
                door_json['width'],
            )
            doors._wall_doors[int(door_json['wall_index'])].append(door)

        return doors

    def __str__(self):
        return f'Doors({str(self._wall_doors)})'

        
class Wall:
    """The wall of a room."""
    DOOR_HEIGHT = 100

    position: Coord
    size: Size
    doors: list[Door]
    css_classes: list[str]

    _collision_parts: list[Part]
    """Parts of the room that are both visual and have collision."""
    _visual_parts: list[Part]
    """Parts of the room that are only visual and have no collision."""

    def get_visual_cubes(self):
        return self._visual_parts
    
    def get_collision_rects(self):
        return self._collision_parts

    def __init__(self, position: Coord, size: Size, doors: list[Door], css_classes: list[str], is_horizontal: bool):
        self.position = position
        self.size = size
        self.doors = doors
        self.css_classes = css_classes

        self._collision_parts = []
        self._visual_parts = []

        self._generate_parts(is_horizontal)

    def _generate_parts(self, is_horizontal: bool):
        current_wall_part = Part(self.position, self.size, self.css_classes)
        for door in sorted(self.doors):
            door_part = current_wall_part.clone()
            next_wall_part = current_wall_part.clone()

            if is_horizontal:
                current_wall_part.size.width = self.position.x + door.position - current_wall_part.position.x

                next_wall_part.position.x = self.position.x + door.position + door.width
                next_wall_part.size.width -= current_wall_part.size.width + door.width

                door_part.position.x = self.position.x + door.position
                door_part.size.width = door.width

            else:
                current_wall_part.size.height = self.position.y + door.position - current_wall_part.position.y

                next_wall_part.position.y = self.position.y + door.position + door.width
                next_wall_part.size.height -= current_wall_part.size.height + door.width

                door_part.position.y = self.position.y + door.position
                door_part.size.height = door.width
            
            door_part.size.depth -= self.DOOR_HEIGHT
            door_part.css_classes.append('pole')

            self._collision_parts.append(current_wall_part)
            self._visual_parts.append(door_part)
            current_wall_part = next_wall_part

        self._collision_parts.append(current_wall_part)


class Room:
    ROOF_THICCNESS = 10

    walls: list[Wall]
    roof: Part 
    """Part with no collision."""

    def get_visual_cubes(self):
        for wall in self.walls:
            for cube in wall.get_visual_cubes():
                yield cube
        yield self.roof

    def get_collision_rects(self):
        for wall in self.walls:
            for cube in wall.get_collision_rects():
                yield cube

    def __init__(self, position: Coord, size: Size, css_classes: list[str], wall_thickness: float, doors: Doors):
        self.walls = [
            Wall(
                position,
                Size(size.width, wall_thickness, size.depth),
                doors.get_doors_of_wall(0),
                css_classes + ['north'],
                True
            ),
            Wall(
                position + (size.width, 0),
                Size(wall_thickness, size.height, size.depth),
                doors.get_doors_of_wall(1),
                css_classes + ['east'],
                False
            ),
            Wall(
                position + (wall_thickness, size.height),
                Size(size.width, wall_thickness, size.depth),
                doors.get_doors_of_wall(2),
                css_classes + ['south'],
                True
            ),
            Wall(
                position + (0, wall_thickness),
                Size(wall_thickness, size.height, size.depth),
                doors.get_doors_of_wall(3),
                css_classes + ['west'],
                False
            ),
        ]

        self.roof = Part(
            position + (wall_thickness, wall_thickness),
            Size(size.width - wall_thickness, size.height - wall_thickness, Room.ROOF_THICCNESS),
            css_classes=["roof"],
            args=['200px'])


class Map:
    rooms: list[Room]
    blocks: list[Part]
    size: Size

    def get_collision_parts(self):
        for room in self.rooms:
            for part in room.get_collision_rects():
                yield part.get_collision_rect()

        for block in self.blocks:
            yield block.get_collision_rect()
    
    def get_visual_parts(self):
        for room in self.rooms:
            for part in room.get_collision_rects():
                yield part.get_visual_cube()

        for room in self.rooms:
            for part in room.get_visual_cubes():
                yield part.get_visual_cube()

        for block in self.blocks:
            yield block.get_visual_cube()
        
    def get_size(self):
        return (self.size.width, self.size.height)

    def __init__(self):
        self.rooms = []
        self.blocks = []

        file = open('src/map.json')
        map_data_raw = file.read()
        file.close()

        map_json = json.loads(map_data_raw)
        for object in map_json:
            match object['type']:
                case "block": self._parse_block(object)
                case "room": self._parse_room(object)
                case "size": self.size = Size.from_json(object['size'])
                case _: raise ValueError('invalid value for type of object.')

    def _parse_block(self, block: dict[str, Any]):
        self.blocks.append(Part(
            Coord.from_json(block['position']),
            Size.from_json(block['size']),
            block['css_classes'],
        ))

    def _parse_room(self, room: dict[str, Any]):
        self.rooms.append(Room(
            Coord.from_json(room['position']),
            Size.from_json(room['size']),
            room['css_classes'],
            20,
            Doors.from_json(room['doors'])
        ))


def getMap():
    map = Map()
    colliders = '\n'.join((str(collider) for collider in map.get_collision_parts()))
    visual_cubes = '\n'.join((str(visual_cube) for visual_cube in map.get_visual_parts()))
    size = map.get_size()
    return colliders, visual_cubes, size
  

# ===================== TESTS ========================

if __name__ == '__main__':
    child = HtmlElement(
        'p',
        style=[
            Style('width', 100, 'px'),
            Style('height', 200, 'rm'),
        ],
        css_classes=['my-css-style']
    )

    parent = HtmlElement(
        'div',
        css_classes=[
            'my-class-1',
            'my-class-2',
        ],
        children=[
            child,
            child,
            child,
        ],
    )

    print(str(parent))
