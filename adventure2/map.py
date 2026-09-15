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
    """The visual component of this part. Will be a cube with a certain texture."""
    visual_cube: HtmlElement
    """The collision rect of this part. Will be just a simple rectangle div."""
    collision_rect: HtmlElement

    def __init__(self, top_left: Coord, size: Size, css_classes: list[str], args: list[str] = []):
        self._set_collision_rect(top_left, size)
        self._set_visual_cube(top_left, size, css_classes, args)

    def _set_collision_rect(self, top_left: Coord, size: Size):
        self.collision_rect = HtmlElement(
            'div',
            style=[
                Style('left', top_left.x, 'px'),
                Style('top', top_left.y, 'px'),
                Style('width', size.width, 'px'),
                Style('height', size.height, 'px'),
            ]
        )

    def _set_visual_cube(self, top_left: Coord, size: Size, css_classes: list[str], args: list[str]):
        style=[
            Style('left', top_left.x, 'px'),
            Style('top', top_left.y, 'px'),
            Style('--width', size.width, 'px'),
            Style('--height', size.height, 'px'),
            Style('--depth', size.depth, 'px'),
        ] + [
            Style(f'--arg{i}', arg, '') for i, arg in enumerate(args)
        ]

        self.visual_cube = HtmlElement(
            css_classes=['cubed'] + css_classes,
            style=style,
            children=[HtmlElement('div') for _ in range(6)]
        )


class Door:
    position: float
    width: float

    def __init__(self, position: float, width: float):
        self.position = position
        self.width = width


"""Represents the 4 doors of a normal house. (yes, a normal house has 4 doors (or less))."""
class Doors:
    door1: None | Door
    door2: None | Door
    door3: None | Door
    door4: None | Door

    def __init__(self):
        self.door1 = None
        self.door2 = None
        self.door3 = None
        self.door4 = None

    @staticmethod
    def from_json(json: list[dict[str, Any]]):
        doors = Doors()
        for door_json in json:
            door = Door(
                door_json['position'],
                door_json['width'],
            )
            match door_json['wall_index']:
                case 1: doors.door1 = door
                case 2: doors.door2 = door
                case 3: doors.door3 = door
                case 4: doors.door4 = door

        return doors


class Room:
    """Parts of the room that are both visual and have collision."""
    collision_parts: list[Part]
    """Parts of the room that are only visual and have no collision."""
    visual_parts: list[Part]

    def get_visual_cubes(self):
        return [part.visual_cube for part in self.collision_parts + self.visual_parts]

    def get_collision_rects(self):
        return [part.collision_rect for part in self.collision_parts]

    def __init__(self, position: Coord, size: Size, css_classes: list[str], wall_thickness: float, doors: Doors):
        self.collision_parts = []
        self.visual_parts = []
        
        width = size.width
        height = size.height
        depth = size.depth

        css_class_north = "north"
        if doors.door1:
            door_pos = doors.door1.position  # type: ignore
            door_width = doors.door1.width  # type: ignore

            self._add_part_with_collision(Part(
                position,
                Size(door_pos, wall_thickness, depth),
                css_classes + [css_class_north]))
            self._add_part_without_collision(Part(
                position + (door_pos, 0),
                Size(door_width, wall_thickness, depth-100),
                css_classes + ["pole", css_class_north]))
            self._add_part_with_collision(Part(
                position + (door_pos + door_width, 0),
                Size(width - door_width - door_pos, wall_thickness, depth),
                css_classes + [css_class_north]))
        else:
            self._add_part_with_collision(Part(
                position,
                Size(width, wall_thickness, depth),
                css_classes + [css_class_north]))

        css_class_east = "east"
        if doors.door2:
            door_pos = doors.door2.position  # type: ignore
            door_width = doors.door2.width  # type: ignore

            self._add_part_with_collision(Part(
                position + (width, 0),
                Size(wall_thickness, door_pos, depth),
                css_classes + [css_class_east]))
            self._add_part_without_collision(Part(
                position + (width, door_pos),
                Size(wall_thickness, door_width, depth-100),
                css_classes + ["pole", css_class_east]))
            self._add_part_with_collision(Part(
                position + (width, door_pos + door_width),
                Size(wall_thickness, height - door_width - door_pos, depth),
                css_classes + [css_class_east]))
        else:
            self._add_part_with_collision(Part(
                position + (width, 0),
                Size(wall_thickness, height, depth),
                css_classes + [css_class_east]))

        css_class_south = "south"
        if doors.door3:
            door_pos = doors.door3.position  # type: ignore
            door_width = doors.door3.width  # type: ignore

            self._add_part_with_collision(Part(
                position + (wall_thickness, height),
                Size(door_pos, wall_thickness, depth),
                css_classes + [css_class_south]))
            self._add_part_without_collision(Part(
                position + (wall_thickness + door_pos, height),
                Size(door_width, wall_thickness, depth-100),
                css_classes + ["pole", css_class_south]))
            self._add_part_with_collision(Part(
                position + (wall_thickness + door_pos + door_width, height),
                Size(width - door_width - door_pos, wall_thickness, depth),
                css_classes + [css_class_south]))
        else:
            self._add_part_with_collision(Part(
                position + (wall_thickness, height),
                Size(width, wall_thickness, depth),
                css_classes + [css_class_south]))

        css_class_west = "west"
        if doors.door4:
            door_pos = doors.door4.position  # type: ignore
            door_width = doors.door4.width  # type: ignore

            self._add_part_with_collision(Part(
                position + (0, wall_thickness),
                Size(wall_thickness, door_pos, depth),
                css_classes + [css_class_west]))
            self._add_part_without_collision(Part(
                position + (0, wall_thickness + door_pos),
                Size(wall_thickness, door_width, depth-100),
                css_classes + ["pole", css_class_west]))
            self._add_part_with_collision(Part(
                position + (0, wall_thickness + door_pos + door_width),
                Size(wall_thickness, height - door_pos - door_width, depth),
                css_classes + [css_class_west]))
        else:
            self._add_part_with_collision(Part(
                position + (0, wall_thickness),
                Size(wall_thickness, height, depth),
                css_classes + [css_class_west]))

        self._add_part_without_collision(Part(
            position + (wall_thickness, wall_thickness),
            Size(width - wall_thickness, height - wall_thickness, 10),
            css_classes=["roof"],
            args=['200px']))

    def _add_part_with_collision(self, wall: Part):
        self.collision_parts.append(wall)
        self._add_part_without_collision(wall)

    def _add_part_without_collision(self, wall: Part):
        self.visual_parts.append(wall)


class Map:
    rooms: list[Room]
    blocks: list[Part]
    size: Size

    def get_collision_parts(self):
        for room in self.rooms:
            for part in room.collision_parts:
                yield part.collision_rect

        for block in self.blocks:
            yield block.collision_rect
    
    def get_visual_parts(self):
        for room in self.rooms:
            for part in room.collision_parts:
                yield part.visual_cube

        for room in self.rooms:
            for part in room.visual_parts:
                yield part.visual_cube

        for block in self.blocks:
            yield block.visual_cube
        
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
