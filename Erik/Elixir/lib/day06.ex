defmodule Aoc16.Day06 do

  def run do
    File.read!("inputs/06_input.txt")
    |> String.trim
    |> String.split("\n")
    |> process_lines
  end

  def process_lines(input, accumulator \\ %{})

  def process_lines([h | t], accumulator) do
    {accumulator, _} =
      String.trim(h)
      |> String.graphemes
      |> Enum.reduce({accumulator, 0}, fn(letter, {acc, counter}) ->
        acc =
          if Map.get(acc, counter, nil) == nil, do: put_in(acc, [counter], %{}), else: acc

        acc = put_in(acc, [counter, letter], Map.get(acc[counter], letter, 0) + 1)
        {acc, counter + 1}
      end)

    process_lines(t, accumulator)
  end

  def process_lines([], accumulator) do
    Map.keys(accumulator)
    |> Enum.sort
    |> process_data(accumulator)
  end

  def process_data(keys, data, highest_word \\ "", lowest_word \\ "")

  def process_data([h | t], data, highest_word, lowest_word) do
    sorted =
      Map.get(data, h)
      |> Enum.sort(fn({_x, y}, {_a, b}) -> y > b end)

    {highest_letter, _} = hd(sorted)
    {lowest_letter, _} = List.last(sorted)

    process_data t, data, highest_word <> highest_letter, lowest_word <> lowest_letter
  end

  def process_data([], _data, highest_word, lowest_word) do
    {highest_word, lowest_word}
  end
end
