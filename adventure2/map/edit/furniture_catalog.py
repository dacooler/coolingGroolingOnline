from itertools import chain
from typing import Iterable

from ..primitives.html_element import HtmlElement


def get_furniture_catalog_entries():
    """Creates a list of radio buttons with all available furniture types for the edit mode form."""

    furniture_types = _load_furniture_types()
    buttons = chain.from_iterable((_generate_radio_button(furniture_type) for furniture_type in furniture_types))
    return _generate_fieldset(buttons)

    
def _load_furniture_types():
    with open('src/furniture.json') as file:
        lines = file.readlines()
        type_lines = filter(lambda line: line.strip().startswith('"type"'), lines)
        furniture_types = [line.split('"')[3] for line in type_lines]
        return furniture_types

        
def _generate_radio_button(furniture_type: str):
    id = f'furniture-{furniture_type}'

    label = HtmlElement(
        tag = 'label',
        attributes={'for': id},
        text=furniture_type.title()
    )

    input = HtmlElement(
        tag='input',
        attributes={
            'id': id,
            'type': 'radio',
            'name': 'furniture',
            'value': furniture_type,
        },
        closing=False
    )

    return label, input


def _generate_fieldset(buttons: Iterable[HtmlElement]):
    children = [_generate_legend()]
    children.extend(buttons)
    fieldset = HtmlElement(
        tag='fieldset',
        children=children
    )
    return fieldset


def _generate_legend():
    return HtmlElement(
        tag='legend',
        text='Furniture type',
    )
